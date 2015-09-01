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
        $this->_expirationDate = $this->get_expiration_date();

        return $this->response = \Market\Market::strikePrice(Input::param('coin_id'), $this->_expirationDate );
    }

    protected function _strikePrice()
    {
        $this->get_expiration_date();

        return  \Market\Market::strikePrice(Input::param('coin_id'), $this->_expirationDate );
    }

    public function get_purchase_price()
    {
        $this->_strike = $this->_strikePrice();
        return $this->response =   \Market\Market::purchasePrice( $category = Input::param('option'),
            $strike = $this->_strike , $quantity = Input::param('quantity'),
            $coin_id = Input::param('coin_id'), $action = Input::param('status') );
    }
}