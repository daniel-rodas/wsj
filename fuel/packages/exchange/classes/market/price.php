<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 8/8/2015
 * Time: 12:54 AM
 */

namespace Exchange\Market;

use Exchange\Market\Option;
use Exchange\Trade\Trade;
use Exchange\Trade\IStrategy;
use Exchange\Trade\Put;
use Exchange\Trade\Call;
use Exchange\Trade\Future;
use Exchange\Trade\Short;

class Price extends Context
{
    public function getLastPrice($coinId)
    {
        if( ! is_int( (integer) $coinId) )
        {
            throw new \PhpErrorException('Coin ID not a valid integer.');
        }

        $information = new Information();
        try {
            return $information->getLastPrice($coinId);
        } catch (\PhpErrorException $e) {
            return $e->getMassage();
        }
    }
    public function strike( $coinId ,  $expirationDate  )
    {
        if( ! is_int( (integer) $coinId) )
        {
            throw new \PhpErrorException('Coin ID not a valid integer.');
        }
        /*
         * Estimate future value prediction of coin based on market price (last price) history.
         * Then, do some linear algebra to get the average trade in rate for the market coin.
         */
        $timeElapsed =  $expirationDate - time();

        $timeFrameBack = time() - abs( 3 * $timeElapsed );

        $information = new Information();

        if( ! $priceHistory = $information->getPriceHistory( $coinId, $timeFrameBack ) )
        {
            throw new \PhpErrorException('Cannot gather price history market information. Please try different market sign or market api.');
        }
        /*
         * Reset array index to find most current last_price
         */
        $lastPrice = array_values($priceHistory);
        $denominatorOfAverages = count($priceHistory);
        $sumOfLastPrice = 0;
        try {
            // Run query and hope for the best.
            foreach($priceHistory as $record)
            {
                $sumOfLastPrice = $sumOfLastPrice + $record->last_price;
            }
        } catch (\PhpErrorException $e) {
            // returns the individual ValidationError objects
            return $e->getMassage();
        }

        $strikePrice = $lastPrice[0]->last_price + ( $sumOfLastPrice / $denominatorOfAverages );

        // Convert scientific notation to decimal notation
        return rtrim( sprintf('%.20F', $strikePrice ), '0');
    }

    public function purchase( $optionType, Option $option )
    {
        $tradeObject = $this->$optionType();
        return $tradeObject->trade( $option );
    }

    public function execute( $optionType, Option $option )
    {
        $tradeObject = $this->$optionType();
        return $tradeObject->trade( $option );
    }
}