<?php

namespace Exchange;

use Market;
/**
 * @ Package Exchange 
 */
class Exchange 
{
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
    }

    public static function forge(){}

    public function newOption( $optionType, $coinId, $userId, $timeFrame )
    {
    	$expirationDate = $this->getExpirationDate( $timeFrame );
    	
    	$this->strikePrice = $price->strike( new History() , $coinId ,  $expirationDate );
    	$this->purchasePrice = $price->purchase( $category, $this->strikePrice, $quantity, $coinId, $action );	    
	    /*
          * Generate serial number for option
          */
        $serial = 'OP' . time() .''.  rand ( 55 , time() );
        
        $this->option->create(
	        $coinId, $serial, $this->strikePrice, $this->expirationDate, $optionType, $userId );
            
    }

    public function sellOption( $optionId, $optionPrice ){}

    public function buyOption( $optionId ){}

    public function executeOption( $optionId ){}
    
    public function getStrikePrice( $coinId, $timeFrame ){}

    public function getExpirationDate( $timeFrame ){}

    public function getPurchasePrice( $optionType, $strikePrice, $quantity,  $optionTrade ){}

}
