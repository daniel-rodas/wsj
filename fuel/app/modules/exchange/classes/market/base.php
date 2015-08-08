<?php

namespace Exchange;

class Market_Base
{
    /*
     * When you sell your option you get debited a %0.01 fee of the purchase price
     */

    /*
     * @var $_option will hold a model of an option
     */
    protected $_option;

    /*
     * @var $_theta will hold the value of Strike X Quantity
     */
    protected $_theta;

     /*
     * @var $_beta will hold the value of  Quantity X LastPrice
     */
    protected $_beta;

    /*
     * @var $_n is used to calculate a fee
     */
    protected $_n = 20;

    /*
     * @var $_m is used to calculate a fee
     */
    protected $_m = 40;

    /*
     * @var $instance to add support for static methods
     */

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


    public static function getMarketInfo(Model_Coin $coin)
    {
        $curl = \Request::forge($coin->api, 'curl');
        $curl->set_params(array('market' => $coin->market));
        $curl->execute();
        $curl = $curl->response();
        return $info = json_decode($curl->body());
    }

    public static function strikePrice( $coinId ,  $expirationDate  )
    {
        /*
         * Future value prediction of coin based of market price history.
         * Now do some linear algebra to get the average change in rate for the market.
         */
        $timeframeInSecondsX3 = time() - ( 3 * $expirationDate );
        $priceHistory = Model_Market_History::find('all', array(
            'where' => array(
                array('coin_id','=',$coinId),
                array('created_at','>',$timeframeInSecondsX3),
            ),
            'order_by' => array('created_at' => 'desc'),
        ));
        /*
         * Reset array index to find most current last_price
         */
        $lastPrice = array_values($priceHistory);
        $denominatorOfAverages = count($priceHistory);
        $sumOfLastPrice = 0;
        foreach($priceHistory as $record)
        {
            $sumOfLastPrice = $sumOfLastPrice + $record->last_price;
        }
        return $lastPrice[0]->last_price + ( $sumOfLastPrice / $denominatorOfAverages );
    }

    public static function purchasePrice($category, $strike, $quantity, $coin_id, $action)
    {
        $inst = self::instance();
        $inst->_option = Model_Option::forge(array(
            'coin_id' => $coin_id,
            'strike' => $strike,
            'quantity' => $quantity,
            'category' => $category,
            'status' => $action,
        ));
        $category = '_'.strtolower($category);
        $inst->_theta = $strike * $quantity;

        /*
         * Get Last Price
         */
        $history = Model_Market_History::find('last', array(
            'where' => array(
                array('coin_id','=',$coin_id),
            ),
            'order_by' => array('created_at' => 'desc'),
        ));
        $lastPrice = $history->last_price;
        $inst->_beta = $quantity * $lastPrice;

        return $inst->$category($action);
    }

    public static function trade(Model_Option $option)
    {
        $category = '_'.strtolower($option->category);
        $inst = self::instance();
        $inst->_theta = $option->strike * $option->quantity;
        /*
         * To get Theta first
         *  Get Last Price
         */
        $history = Model_Market_History::find('last', array(
            'where' => array(
                array('coin_id','=',$option->coin_id),
            ),
            'order_by' => array('created_at' => 'desc'),
        ));
        $lastPrice = $history->last_price;
        $inst->_beta = $option->quantity * $lastPrice;
        return $inst->$category($option->status);
    }

    protected function _call($action)
    {
        /*
         * User has to pay for the rest of the call option when they execute
         * But there is not obligation to execute for a call option
         * The option is like a very light down payment and they're only obligated to pay in full if they execute
         */
        $this->_n = 17;
        $this->_m = 75;

        switch($action) :

            case 'New':
                /* 1. option of cost - NEW */
                return - ( $this->_theta / $this->_n );

            case 'Sell':
                return true;

            case 'Sold':
                return true;

            case 'Execute':
                /* 2. cost if they execute - Execute */
                return $this->_theta + ( $this->_theta / $this->_m );

            case 'Expire':
                /*  3. cost of execute - After Execute*/
                return ( $this->_theta / $this->_n ) +  $this->_beta ;
        endswitch;
    }

    protected function _put($action)
    {
        $this->_n = 17;
        $this->_m = 75;

        switch($action) :

            case 'New':
                /* 1. option of cost - NEW */
                return - ( $this->_theta / $this->_n );

            case 'Sell':
                return true;

            case 'Sold':
                return true;

            case 'Execute':
                /* 2. cost if they execute - Execute (Put is no obligation)*/
                return $this->_beta + ( $this->_beta / $this->_m  ); /*  cost of execute */ /* cost if they execute */;

            case 'Expire' :
                /*  3. cost of execute - After Execute*/
                return $this->_theta ;
        endswitch;
    }

    protected function _short($action)
    {
        $this->_n = 13;
        $this->_m = 75;

        switch($action) :
            case 'New':
                /* 1. option of cost - NEW */
                return - ( $this->_theta / $this->_n );

            case 'Sell':
                return true;

             case 'Sold':
                return true;

            case 'Execute':

                return $this->_theta;

            case 'Expire' :
                /*  3. cost of execute - After Execute*/
                return - ( $this->_beta );
        endswitch;

    }

    protected function _future($action)
    {
        $this->_n = 17;
        $this->_m = 75;

        switch($action) :
            case 'New':
                /* 1. option of cost - NEW */
                return - (  $this->_theta + ( $this->_theta / $this->_n ) );

            case 'Sell':
                return true;

            case 'Sold':
                return true;

            case 'Execute':

                return $this->_beta;

            case 'Expire' :
                /*  3. cost of execute - After Execute*/
                return $this->_beta;
        endswitch;
    }
}