<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 8/8/2015
 * Time: 12:54 AM
 */

namespace Exchange\Market;

use Exchange\Model\Coin;
use Exchange\Model\Option as Model_Option;

class Option extends Base
{
    protected function create(
        $coinId,
        $strikePrice,
        $expirationDate,
        $optionType,
        $userId,
        $purchasePrice,
        $quantity,
        $serial = null)
    {

    /*
          * Generate serial number for option
          */
        $serial = 'OP' . time() .''.  rand ( 55 , time() );

        $val = Model_Option::validate_new('create_option');
        if ($val->run(array(
            'serial' => $serial,
            'strike' => $strikePrice,
            'expiration_date' => $expirationDate,
            'category' => $optionType ), true))
        {
            /*
             * Validation was successful
             * Now create a new ORM object then
             * Populate Model_Option with user input then save in DB
             */
            $option = Model_Option::forge(array(
                'coin_id' => $coinId,
                'serial' => $serial,
                'quantity' => $quantity,
                'price' => $purchasePrice,
                'strike' => $strikePrice, /* once this value is set it should not change */
                'category' => $optionType,
                'status' => 'New', /*  enum("New","Sell","Sold","Execute"); */
                'user_id' => $userId, /* user_id is the current owner of an option */
                'expiration_date' => $expirationDate,
            ))->save();
        }
        else
        {
            die( 'error' . $val->error() );

        }
    }
    protected function sell(){}
    protected function buy(){}
    protected function execute(){}

    /*
    	 * Gets Quantity of Option.
    	 *
    	 * @return  int  Number of coins included in this option
    	 */
    public function getQuantity(){}
    public function getStrike(){}
    public function getStatus(){}
    public function getType(){}
}