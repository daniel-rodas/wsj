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

class Buy implements IStrategy
{
    public function __construct( $id )
    {
        if( ! $this->model = Model_Option::find($id) )
        {
            throw new \Exception("Option with id: $id not found.");
        }

        if( $this->model->status !== 'Sell' )
        {
            throw new \Exception("Option with id: $id is not for sale.");
        }
    }

    public function algorithmTrade( $option )
    {
        $option->set( 'status', 'Buying');

        $val = $this->model->validate_buy('buy_option');
        if ( $val->run( [ 'user_id' => $option->getUserId(), 'status' => 'Sold'] , true) )
        {
            /*
             * Validation was successful
             * Now create a new ORM object then
             * Populate Model_Option with user input then save in DB
             */
            try {
                // Run query and hope for the best.

                $this->model->status = 'Sold';
                $this->model->user_id = $option->getUserId();
                $this->model->save();

                return $option;

            } catch (Orm\ValidationFailed $e) {
                // returns the individual ValidationError objects
                $errors = $e->get_fieldset()->validation()->error();
            }
        }
        else
        {
            return $val->error() ;
        }
    }
}