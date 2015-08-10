<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 8/8/2015
 * Time: 12:54 AM
 */

namespace Exchange\Market\Trade;

use Exchange\Market\Base;
use Exchange\Model\Market\History;
use Exchange\Model\Option;

abstract class Trade extends Base
{
    /*
 * When you sell your option you get debited a %0.01 fee of the purchase price
 */

    /*
     * @var $_option will hold a model of an option
     */
    protected $_option;

    /*
     * @var $_option will hold a model of an option
     */
    protected $_price;

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

    public function __construct(Option $option ,  History $history)
    {
        // TODO Call new Trade() Object, Call, Put, Future, or Short.
        $this->_option = $option;
        $this->_price = $history;

        $category = '_'.strtolower($option->category);

        $this->_theta = $option->strike * $option->quantity;
        /*
         * To get Theta first
         *  Get Last Price
         */
        $history = History::find('last', array(
            'where' => array(
                array('coin_id','=',$option->coin_id),
            ),
            'order_by' => array('created_at' => 'desc'),
        ));
        $lastPrice = $history->last_price;
        $this->_beta = $option->quantity * $lastPrice;
        return $this->$category($option->status);
    }

    protected abstract function trade($action);
}