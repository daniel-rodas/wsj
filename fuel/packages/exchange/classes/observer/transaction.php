<?php

namespace Exchange\Observer;

use Exchange\Model\Coin;
use Exchange\Market\Information;

class Transaction extends \Orm\Observer
{
    public function after_insert(\Orm\Model $model)
    {
        /*
         * Using a static method
         * Send cURL request to crypto currency market API
         */
        $info = new Information();
        try {
            // Run query and hope for the best.
            $modelCoin = Coin::query()->where('id', $model->coin_id )->get_one();
        } catch (\PhpErrorException $e) {
            // returns the individual ValidationError objects
            echo  $e->getMessage();
        }

        $info = $info->get( $modelCoin );


        list(, $userId) = \Auth::get_user_id();
        // Only record market information for coin if response is successful.
        if( $info['success'] ) {// Convert scientific notation to decimal notation
            $lastPrice = rtrim(sprintf('%.20F', $info['result']['Last']), '0');
            $trans_props = array(
                'user_id' => $userId,
                'option_id' => $model->id,
                'action' => $model->status,
                'purchase' => $model->price,
                'market' => $lastPrice,
            );
            try {
                // Run query and hope for the best.
                return \Exchange\Model\Transaction::forge($trans_props)->save();
            } catch (Orm\ValidationFailed $e) {
                // returns the individual ValidationError objects
                $errors = $e->get_fieldset()->validation()->error();
            }
        }
    }

    public function after_update(\Orm\Model $model)
    {
        /*
         * Using a static method
         * Send cURL request to crypto currency market API
         */

        $info = new Information();

        // TODO DRY
        try {
            // Run query and hope for the best.
            $modelCoin = Coin::query()->where('id', $model->coin_id )->get_one();
        } catch (\PhpErrorException $e) {
            // returns the individual ValidationError objects
            echo  $e->getMessage();
        }

        $info = $info->get( $modelCoin );

        // Only record market information for coin if response is successful.
        if( $info['success'] ) {// Convert scientific notation to decimal notation
            $lastPrice = rtrim(sprintf('%.20F', $info['result']['Last']), '0');
            list(, $userId) = \Auth::get_user_id();
            $trans_props = array(
                'user_id' => $userId,
                'option_id' => $model->id,
                'action' => $model->status,
                'purchase' => $model->price,
                'market' => $lastPrice,
            );

            return \Exchange\Model\Transaction::forge($trans_props)->save();
        }
    }
}






