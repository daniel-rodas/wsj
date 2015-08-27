<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 8/8/2015
 * Time: 12:54 AM
 */

namespace Exchange\Market;

use Exchange\Market\Option\Create;
use Exchange\Market\Option\Execute;
use Exchange\Market\Option\Sell;
use Exchange\Market\Option\Buy;
//use Exchange\Model\Option as Model_Option;

class Option extends Context
{
    // TODO https://en.wikipedia.org/wiki/Fluent_interface#PHP
    protected $strikePrice;
    protected $price = null;
    protected $type;
    protected $expirationDate;
    protected $quantity;
    protected $coinId;
    protected $userId;
    protected $status;
    protected $serial;

    /*
     * @var $model will hold the value of Model\Option
     */
    public $model;
    /*
     * @var $theta will hold the value of Strike X Quantity
     */
    public $theta;

    /*
    * @var $beta will hold the value of  Quantity X LastPrice
    */
    public $beta;

    /*
     * @var $n is used to calculate a fee
     */
    public $n = 20;

    /*
     * @var $m is used to calculate a fee
     */
    public $m = 40;

    public function set( $key, $value )
    {
        $this->$key = $value;
    }

    public function create()
    {
        $deal = new Create();
        return $deal->algorithmTrade( $this );
    }

    public function sell( $optionId )
    {
        $deal = new Sell( $optionId );
        return $deal->algorithmTrade( $this );
    }

    public function buy( $optionId )
    {
        $deal = new Buy( $optionId );
        return $deal->algorithmTrade( $this );
    }
    
    public function execute( $optionId )
    {
        $deal = new Execute( $optionId );
        return $deal->algorithmTrade( $this );
    }

    public function getType(){ return (string) $this->type; }
    public function getQuantity(){ return (integer) $this->quantity; }
    public function getExpiration(){ return (integer) $this->expirationDate; }
    public function getStrike(){ return (float) $this->strikePrice; }
    public function getPrice(){ return ( is_null($this->price) ? $this->price : (float) $this->price ); }
    public function getCoinId(){ return (integer) $this->coinId; }
    public function getUserId(){ return (integer) $this->userId; }
    public function getStatus(){ return (string) $this->status; }
    public function getSerial(){ return (string) $this->serial; }

    public function generateSerial()
    {
        /*
         * Generate serial number for option
         *  */

       $this->serial = 'OP' . time() .''.  rand ( 55 , time() );
    }
}