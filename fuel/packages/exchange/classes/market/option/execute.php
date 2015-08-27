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
use Exchange\Market\Price;

class Execute implements IStrategy
{
    protected $price;

    public function __construct( $id )
    {
        if( ! $this->model = Model_Option::find($id) )
        {
            throw new \Exception("Option with id: $id not found.");
        }

        if( $this->model->status === 'Execute' )
        {
            throw new \Exception("Option with id: $id has already been executed.");
        }
    }

    public function algorithmTrade( $option )
    {
        // Set Option parameters
        $option->set( 'strikePrice', $this->model->strike );
        $option->set( 'quantity', $this->model->quantity );
        $option->set( 'expirationDate', $this->model->expiration_date );

        $option->set( 'coinId', $this->model->coin_id );

        $option->set( 'status', 'Executing');
        $option->set( 'type', $this->model->category);

        // Calculate Execution Price based on Option parameters
        $executionPrice = $this->getExecutionPrice( $option );
        $option->set( 'price', $executionPrice );

        $val = $this->model->validate_buy('execute_option');
        if ( $val->run( [ 'price' => $option->getPrice(), 'status' => 'Execute'] , true) )
        {
            /*
             * Validation was successful
             * Now create a new ORM object then
             * Populate Model_Option with user input then save in DB
             */
            try {
                // Run query and hope for the best.

                $this->model->status = 'Execute';
                $this->model->price = $option->getPrice();
                $this->model->save();

                $option->set( 'status', 'Executed');
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

    protected function getExecutionPrice( $option )
    {
        $this->price = new Price();
        return $this->price->execute( $option->getType() , $option );
    }
}