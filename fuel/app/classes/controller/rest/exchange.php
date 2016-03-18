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

    public function get_all_coins()
    {
        return $this->response(
            [
                // Figure out expiration date for option
                 $this->exchange->getAllCoins()

            ]);
    }

    public function get_coin()
    {
        return $this->response(
            [
                $this->exchange->getCoin( Input::param('coin_id') )
            ]);
    }

    public function get_last_price()
    {
        return $this->response(
            [
                $this->exchange->getLastPrice( Input::param('coin_id') )
            ]);
    }

    public function get_expiration_date()
    {
        return $this->response(
            [
                // Figure out expiration date for option
                 $this->exchange->getExpirationDate( Input::param('timeframe') )
            ]);
    }

    public function get_strike_price()
    {
        return $this->response(
            [
                // Figure out expiration date for option
                 $this->exchange->getStrikePrice( Input::param('coinId'),  Input::param('expirationDate') )
            ]);
    }

    /**
     * @param $optionType
     * @param $quantity
     * @param $timeFrame
     * @return mixed
     */
    public function get_purchase_price()
    {
        $option = $this->exchange->initializeOption( Input::param('option_type'), Input::param('quantity'),
            Input::param('strike_price'), Input::param('coin_id') );

        return $this->response(
            [
                // Figure out expiration date for option
                 $this->exchange->getPurchasePrice( $option )
            ]);
    }
}