<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 8/8/2015
 * Time: 12:54 AM
 */

namespace Exchange\Market;

class Price extends Base
{
    public static function last(){}

    public static function strike( $coinId ,  $expirationDate  )
    {
        /*
         * Future value prediction of coin based of market price history.
         * Now do some linear algebra to get the average change in rate for the market.
         *
         *
         */
        $timeframeInSecondsX3 = time() - ( 3 * $expirationDate );
        $priceHistory = \Exchange\Model\Market\History::find('all', array(
            'where' => array(
                array('coin_id','=',$coinId),
                array('created_at','>',$timeframeInSecondsX3),
            ),
            'order_by' => array('created_at' => 'desc'),
        ));
        /*
         * Reset array index to find most current last_price
         */
        $lastPrice = array_values($priceHistory);
        $denominatorOfAverages = count($priceHistory);
        $sumOfLastPrice = 0;
        foreach($priceHistory as $record)
        {
            $sumOfLastPrice = $sumOfLastPrice + $record->last_price;
        }
        return $lastPrice[0]->last_price + ( $sumOfLastPrice / $denominatorOfAverages );
    }

    public static function purchase($category, $strike, $quantity, $coin_id, $action)
    {
        $inst = self::instance();
        $inst->_option = \Exchange\Model\Option::forge(array(
            'coin_id' => $coin_id,
            'strike' => $strike,
            'quantity' => $quantity,
            'category' => $category,
            'status' => $action,
        ));
        $category = '_'.strtolower($category);
        $inst->_theta = $strike * $quantity;

        /*
         * Get Last Price
         */
        $history = \Exchange\Model\Market\History::find('last', array(
            'where' => array(
                array('coin_id','=',$coin_id),
            ),
            'order_by' => array('created_at' => 'desc'),
        ));
        $lastPrice = $history->last_price;
        $inst->_beta = $quantity * $lastPrice;

        return $inst->$category($action);
    }

}