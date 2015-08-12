<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 8/8/2015
 * Time: 12:54 AM
 */

namespace Exchange\Market;

use Exchange\Model\Option as Model_Option;

class Option extends Base
{
    // TODO https://en.wikipedia.org/wiki/Fluent_interface#PHP
    protected $strikePrice;
    protected $type;
    protected $expirationDate;
    protected $quantity;
    protected $coinId;
    protected $userId;
    protected $status;

    public function set( $key, $value )
    {
        $this->$key = $value;
    }

    public function create( $purchasePrice, $serial = null )
    {
        $this->status = 'Initialized';
    /*
          * Generate serial number for option
          */
        $serial = 'OP' . time() .''.  rand ( 55 , time() );

        $val = Model_Option::validate_new('create_option');
        if ($val->run(array(
            'serial' => $serial,
            'strike' => $this->strikePrice,
            'expiration_date' => $this->expirationDate,
            'category' => $this->type ), true))
        {
            /*
             * Validation was successful
             * Now create a new ORM object then
             * Populate Model_Option with user input then save in DB
             */
             $option = Model_Option::forge(array(
                'coin_id' => $this->coinId,
                'serial' => $serial,
                'quantity' => $this->quantity,
                'price' => $purchasePrice,
                'strike' => $this->strikePrice, /* once this value is set it should not change */
                'category' => $this->type,
                'status' => 'New', /*  enum("New","Sell","Sold","Execute"); */
                'user_id' => $this->userId, /* user_id is the current owner of an option */
                'expiration_date' => $this->expirationDate,
            ))->save();

            $this->status = 'New';

            die('Congratulations on creating an Option');

        }
        else
        {
            die( 'error' . $val->error() );

        }
    }
    protected function sell(){}
    protected function buy(){}
    protected function execute(){}

    public function getType(){ return (string) $this->type; }
    public function getQuantity(){ return (integer) $this->quantity; }
    public function getStrike(){ return (float) $this->strikePrice; }
    public function getCoinId(){ return (integer) $this->coinId; }
    public function getStatus(){ return (string) $this->status; }
}