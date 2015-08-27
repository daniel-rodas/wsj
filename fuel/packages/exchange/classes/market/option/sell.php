<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 8/17/2015
 * Time: 10:53 PM
 */

namespace Exchange\Market\Option;

use Exchange\IStrategy;
use Exchange\Market\Option;
use Exchange\Model\Option as Model_Option;

class Sell implements IStrategy
{
    public function __construct( $id )
    {
        if( ! $this->model = Model_Option::find($id) )
        {
            throw new \Exception("Option with id: $id not found.");
        }

        if( $this->model->status === 'Execute' )
        {
            throw new \Exception("Option with id: $id cannot be sold because has been executed. ");
        }
    }

    public function algorithmTrade( $option )
    {
        $option->set( 'status' , 'Selling' );

        // Set new sell price or look up
        if( is_numeric($option->getPrice()) )
        {
            $sellPrice = $option->getPrice();
        }
        else
        {
            $sellPrice = $this->model->price;
        }

        $val = $this->model->validate_sell('sell_option');
        if ( $val->run( ['price' => $sellPrice, 'status' => 'Sell'] , true) )
        {
            /*
             * Validation was successful
             * Now create a new ORM object then
             * Populate Model_Option with user input then save in DB
             */
            try {
                // Run query and hope for the best.
                $this->model->price = $sellPrice;
                $this->model->status = 'Sell';
                $this->model->save();

                return $option;

            } catch (Orm\ValidationFailed $e) {
                // returns the individual ValidationError objects
                $errors = $e->get_fieldset()->validation()->error();
            }
        }
        else
        {
            die( 'error' . $val->error() );
        }
    }

}