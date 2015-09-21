<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 9/8/14
 * Time: 12:19 PM
 */

class Controller_Rest_Exchange extends \Controller_Rest
{
    protected $exchange;
    protected $priceHistory;
    protected $strike;
    protected $expirationDate;

    public function before()
    {
        parent::before();

        // Load Exchange package
        \Package::load('Exchange');
        $this->exchange = \Exchange\Exchange::forge();
    }

    public function get_expiration_date()
    {
        return $this->response(
            [
                // Figure out expiration date for option
                'expiration' => $this->exchange->getExpirationDate( Input::param('timeframe') )
            ]);
    }

    public function get_strike_price()
    {
        return $this->response(
            [
                // Figure out expiration date for option
                'strikePrice' => $this->exchange->getStrikePrice( Input::param('coinId'),  Input::param('expirationDate') )
            ]);
    }

    public function get_purchase_price()
    {

        return $this->response(
            [
                // Figure out expiration date for option
                'purchacePrice' => $this->exchange->getPurchasePrice( Input::param('timeframe') )
            ]);
    }
}