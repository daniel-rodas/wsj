<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 8/8/2015
 * Time: 12:54 AM
 */

namespace Exchange\Trade;
//
//use Exchange\Market\Information;
//use Exchange\Market\Option;

class Trade
{
    /*
    * When you sell your option you get debited a %0.01 fee of the purchase price
    */

    /*
     * @var $option will hold a market option
     */
    protected $option;

    /*
     * @var $optionType will hold a value of an optionType
     */
    protected $optionType;

    /*
     * @var $information will hold a History object to get last price value
     */
    protected $information;

    /*
     * @var $trade will hold instance of Trade object.
     */
    protected $tradeStrategy;
   
    /*
     * @var $price will hold a Price object
     */
    protected $price;

    /*
     * @var $theta will hold the value of Strike X Quantity
     */
    protected $theta;

    /*
    * @var $beta will hold the value of  Quantity X LastPrice
    */
    protected $beta;

    /*
     * @var $n is used to calculate a fee
     */
    protected $n = 20;

    /*
     * @var $m is used to calculate a fee
     */
    protected $m = 40;

    /*
     *
     * @usage
     *      $trade = new Trade( new <Trade>(), New Information(), new Option(),  Option->category );
     *      $trade->trade();
     */

    public function __construct(Trade $tradeObject, Information $information = null , Option $option = null  ,   $optionType = null )
    {
        $this->tradeStradegy = $tradeObject;
        $this->information = $information;
        $this->option = $option || null;
        $this->optionType = $option->getType() || $optionType;
    }

    public function trade()
    {
        /*
         * 1. Get Theta from
         *      Option's StrikePrice multiplied by the Quantity.
         * 2. Get LastPrice from
         *      Market Information object
         * 3. Get Beta from
         *      Option's Quantity and StrikePrice
         * 4. Hand over request to TradeStrategy for running algorithm
         *
         */

        $this->theta = $this->option->getStrike() * $this->option->getQuantity();

        // TODO get me a coinId
        $lastPrice = $this->information->getLastPrice( coinId );

        $this->beta = $this->option->getQuantity() * $lastPrice;

        return $this->tradeStradegy->algorithmTrade( $this->option->getStatus() );
    }

    protected function algorithmTrade( $action ){}
}