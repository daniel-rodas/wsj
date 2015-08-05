<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 9/8/14
 * Time: 12:19 PM
 */

class Controller_Rest_Market extends \Controller_Rest
{

    protected $response; /* Use variable to hold response back to client */
    protected $_priceHistory;
    protected $_strike;

    protected $_expirationDate; /* Put expiration Date in HERE */

    public function before()
    {
        parent::before();
        /*
         * Since this is a Being used as a REST controller create
         * create a Respsonse object instead of sending back views
         */
        $this->response = \Response::forge();

    }

    public function get_expiration_date()
    {
        // Figure out expiration date for option
        switch (Input::param('timeframe')) {
            case '30m':
                return $this->_expirationDate = time() + ((60 * 60) / 2);

            case '90m':
                return $this->_expirationDate = time() + ((60 * 60) * 1.5);

            case '6h':
                return $this->_expirationDate = time() + (6 * 60 * 60);

            case '1d':
                return $this->_expirationDate = time() + (24 * 60 * 60);

            case '7d':
                return $this->_expirationDate = time() + (7 * 24 * 60 * 60);

            default:
                /*
                * If the user does not pick a set the option to expire at the current time.
                */
                return $this->_expirationDate = time();
        }
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