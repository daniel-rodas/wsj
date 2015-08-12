<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 8/8/2015
 * Time: 12:54 AM
 */

namespace Exchange\Market;

use Exchange\Trade\Trade;
use Exchange\Trade\IStrategy;
use Exchange\Trade\Put;
use Exchange\Trade\Call;
use Exchange\Trade\Future;
use Exchange\Trade\Short;

class Price extends Base
{
    public function strike( $coinId ,  $expirationDate  )
    {

        /*
         * Estimate future value prediction of coin based on market price (last price) history.
         * Now do some linear algebra to get the average change in rate for the market.
         */
        $timeElapsed =  $expirationDate - time();

        $timeFrameBack = time() - ( 3 * $timeElapsed );

        $information = new Information();
        $priceHistory = $information->getPriceHistory( $coinId, $timeFrameBack );
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

        $strikePrice = $lastPrice[0]->last_price + ( $sumOfLastPrice / $denominatorOfAverages );

        // Convert scientific notation to decimal notation
        return rtrim( sprintf('%.20F', $strikePrice ), '0');
    }

    public function purchase( $optionType, $option )
    {
        $tradeObject = $this->$optionType();
        return $tradeObject->trade( $option );
    }
}