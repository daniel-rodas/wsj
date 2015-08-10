<?php

namespace Exchange;


/**
 * @ Package Exchange 
 */
class Exchange 
{
	public function create(){}

    public function newOption( $optionType ){}

    public function sellOption( $optionId, $optionPrice ){}

    public function buyOption( $optionId ){}

    public function executeOption( $optionId ){}

    public function getStrikePrice( $coinId, $timeFrame ){}

    public function getExpirationDate( $timeFrame ){}

    public function getPurchasePrice( $optionType, $strikePrice, $quantity,  $optionTrade ){}

}
