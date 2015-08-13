<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 8/8/2015
 * Time: 12:54 AM
 */

namespace Exchange\Trade;

use Exchange\Market\Information;
use Exchange\Market\Option as Market_Option;

Class Trade
{
    /*
     * Acts as <Context> for strategy pattern
     */

    /*
    * When you sell your option you get debited a %0.01 fee of the purchase price
    */

    /*
     * @var $option will hold a market option
     */
    protected $option;

    /*
     * @var $information will hold a Information object to get last price value
     */
    protected $information;

    /*
     * @var $trade will hold instance of Trade object.
     */
    protected $tradeStrategy;

    /*
     *
     * @usage
     *      $trade = new Trade( new <IStrategy>() );
     *      $trade->trade( Market_Option $option  );
     */

    public function __construct(IStrategy $tradeObject )
    {
        $this->tradeStradegy = $tradeObject;
        $this->information = new Information();
    }

    public function trade( Market_Option $option  )
    {
        $this->option = $option;
        /*
         * 1. Get Theta from
         *      Option's StrikePrice multiplied by the Quantity.
         * 2. Get LastPrice from to help calculate Beta
         *      Market Information object
         * 3. Get Beta from
         *      Option's Quantity multiplied by LastPrice
         * 4. Hand over request to TradeStrategy for running algorithm
         *
         */

        $this->option->theta = $this->option->getStrike() * $this->option->getQuantity(); // 1.

        $lastPrice = $this->information->getLastPrice( $this->option->getCoinId() ); // 2.

        $this->option->beta = $this->option->getQuantity() * $lastPrice; // 3.

        return $this->tradeStradegy->algorithmTrade( $this->option ); // 4.
    }
}