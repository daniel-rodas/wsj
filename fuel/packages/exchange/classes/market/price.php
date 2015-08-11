<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 8/8/2015
 * Time: 12:54 AM
 */

namespace Exchange\Market;

use Exchange\Market\Information;

class Price extends Base
{




    public static function last(){}

    public static function strike( Information $information, $coinId ,  $expirationDate  )
    {
        /*
         * Future value prediction of coin based of market price history.
         * Now do some linear algebra to get the average change in rate for the market.
         *
         *
         */
        $timeFrameInSecondsX3 = time() - ( 3 * $expirationDate );

        $priceHistory = $history->getPriceHistory( $coinId, $timeFrameInSecondsX3);
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

    public function get_purchase_price()
    {
        $this->_strike = $this->get_strike_price();
        return  \Market\Market::purchasePrice(
            $category = Input::param('option'),
            $strike = $this->_strike ,
            $quantity = Input::param('quantity'),
            $coin_id = Input::param('coin_id'),
            $action = Input::param('status') );
    }


    public static function purchase($optionType, $strikePrice, $quantity, $coinId, $action)
    {
//
//        \Market\Market::purchasePrice( $category = Input::param('option'),
//            $strike = $this->_strike , $quantity = Input::param('quantity'),
//            $coin_id = Input::param('coin_id'), $action = Input::param('status') );
//
        $option = \Exchange\Model\Option::forge(array(
            'coin_id' => $coinId,
            'strike' => $strikePrice,
            'quantity' => $quantity,
            'category' => $optionType,
            'status' => $action,
        ));

        $theta = $strikePrice * $quantity;

        /*
         * Get Last Price
         */

        $history = \Exchange\Model\Market\History::find('last', array(
            'where' => array(
                array('coin_id','=',$coinId),
            ),
            'order_by' => array('created_at' => 'desc'),
        ));
        $lastPrice = $history->last_price;
        $beta = $quantity * $lastPrice;

        return $inst->$category($action);
    }

}