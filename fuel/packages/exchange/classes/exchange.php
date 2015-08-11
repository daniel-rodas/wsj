<?php

namespace Exchange;

use Exchange\Market\Price;
use Exchange\Trade\Trade;

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

    protected $price;
    protected $history;

    protected function __construct()
    {
        $this->price = new Price();
        $this->history = new History();
    }

    public function newOption( $optionType, $coinId, $userId, $timeFrame , $quantity , $action )
    {
    	$expirationDate = $this->getExpirationDate( $timeFrame );
    	
    	$strikePrice = $this->price->strike( $this->history , $coinId ,  $expirationDate );
    	$purchasePrice = $this->getPurchasePrice( $optionType, $strikePrice, $quantity, $coinId, $action );

        $this->option->create(
	        $coinId, $this->strikePrice, $expirationDate, $optionType, $userId, $purchasePrice, $quantity );
            
    }

    public function sellOption( $optionId, $optionPrice ){}

    public function buyOption( $optionId ){}

    public function executeOption( $optionId ){}
    
    public function getStrikePrice( $coinId, $timeFrame,  $expirationDate )
    {
        $this->price->strike( $this->history , $coinId ,  $expirationDate );
    }

    public function getExpirationDate( $timeFrame ){}

    public function getPurchasePrice( $optionType, $strikePrice, $quantity,  $optionTrade )
    {
        $this->price->purchase( $optionType, $strikePrice, $quantity, $coinId, $action );
    }

}
