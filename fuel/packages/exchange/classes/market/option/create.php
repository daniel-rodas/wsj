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

class Create implements IStrategy
{
    public function algorithmTrade( $option )
    {
        $option->set( 'status', 'Creating');
        $option->generateSerial();

        $val = Model_Option::validate_new('create_option');
        if ($val->run(['coin_id' => $option->getCoinId(),'serial' => $option->getSerial(),'quantity' => $option->getQuantity(),'strike' => $option->getStrike(),
            'expiration_date' => $option->getExpiration(),'category' => $option->getType(), 'user_id' => $option->getUserId() ], true))
        {
            /*
             * Validation was successful
             * Now create a new ORM object then
             * Populate Model_Option with user input then save in DB
             */
            try {
                // Run query and hope for the best.
                Model_Option::forge(array(
                    'coin_id' => $option->getCoinId(),
                    'serial' => $option->getSerial(),
                    'quantity' => $option->getQuantity(),
                    'price' => $option->getPrice(),
                    'strike' => $option->getStrike(), /* once option value is set it should not trade */
                    'category' => $option->getType(),
                    'status' => 'New', /*  enum("New","Sell","Sold","Execute"); */
                    'user_id' => $option->getUserId(), /* user_id is the current owner of an option */
                    'expiration_date' => $option->getExpiration(),
                ))->save();

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