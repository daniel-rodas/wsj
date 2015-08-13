<?php

namespace Exchange;

use Exchange\Market\Price;
use Exchange\Market\Option;
use Exchange\Expiration\Date;
/**
 * @ Package Exchange 
 */
class Exchange 
{
    protected $price;
    protected $option;
    private static $_instance = null;

    private static function instance()
    {
        /*
         * Singleton to call internal method
         */
        if(is_null( self::$_instance) )
        {
            self::$_instance = new self();
            return self::$_instance;
        }
        return self::$_instance;
    }

    public static function forge()
    {
     return self::instance();
    }


    protected function __construct()
    {
        $this->price = new Price();
        $this->option = new Option();
    }

    public function newOption( $optionType ,  $quantity , $timeFrame , $coinId , $userId )
    {
        $expirationDate = $this->getExpirationDate( $timeFrame );

        // Calculate Strike Price based on future predictions using market history
    	$strikePrice = $this->getStrikePrice(  $coinId ,  $expirationDate );

        // Set Option parameters
        $this->option->set( 'strikePrice', $strikePrice );
        $this->option->set( 'quantity', $quantity );
        $this->option->set( 'type', $optionType );
        $this->option->set( 'expirationDate', $expirationDate );
        $this->option->set( 'userId', $userId );
        $this->option->set( 'coinId', $coinId );
        $this->option->set( 'status', 'Initialized' );

        // Calculate Purchase Price based on Option parameters
        $purchasePrice = $this->getPurchasePrice( $this->option );
        $this->option->set( 'price', $purchasePrice );

        try {
            // Run query and hope for the best.
            return $this->option->create();
        } catch ( \PhpErrorException $e) {
            // returns the individual ValidationError objects
            return $e->getMessage();
        }
    }

    public function sellOption( $optionId, $optionPrice ){}

    public function buyOption( $optionId ){}

    public function executeOption( $optionId ){}
    
    public function getStrikePrice( $coinId,  $expirationDate )
    {
        return $this->price->strike(  $coinId ,  $expirationDate );
    }

    public function getExpirationDate( $timeFrame )
    {
        $date = new Date();
        return $date->get( $timeFrame );
    }

    public function getPurchasePrice( $option )
    {
        return $this->price->purchase( $option->getType() , $option );
    }
}