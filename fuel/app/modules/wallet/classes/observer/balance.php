<?php

namespace Wallet;

class Observer_Balance extends \Orm\Observer
{
    public static function _init()
    {
        // this is called upon loading the class
        \Package::load('exchange');
    }

    public function after_insert(\Orm\Model $model)
    {
        /*
         * When user creates new option
         * Debit the balance
         *
         */

        $credit = 0;
        $debit = 0;
        $description =  'Option ID'.$model->id . ', ' . $model->status .' Action ';
        /*
         *    --customer balance
         * */
        $sql = 'SELECT user_id, (SUM(debit)*-1) + SUM(credit)
                AS balance FROM balances WHERE user_id = '. $model->user_id . ' GROUP BY user_id ';

        $balance = \DB::query($sql)->execute();

         if( 0 === count( $balance ))
         {// zero customer balance means that use has no records or a zero balance, update new balance
             $description .=  ' - First Debit';
             $balance =  $model->price;
             $debit = abs( $model->price );
             $props = array(
                 'user_id' => $model->user_id,
                 'description' => $description,
                 'debit' => $debit,
                 'credit' => $credit,
                 'balance' => $balance,

             );
         }
        else
        {
            $description .=  ' - Debit';
            $balance = $balance[0]['balance'];
            $debit = abs( $model->price );

            $balance = $balance - $debit;
            $props = array(
                'user_id' => $model->user_id,
                'description' => $description,
                'debit' => $debit,
                'credit' => $credit,
                'balance' => $balance,

            );
        }
        return Model_Balance::forge($props)->save();
    }

    public function after_update(\Orm\Model $model)
    {
        if($model->status === 'Sell')
        {
            /*
             * No need to set change balance if listing option for to sell
             */
            return true;
        }

        if($model->status === 'Sold')
        {

            /*
             * Need to credit seller
             */
            $sell_transaction = \Exchange\Model\Transaction::find('last', array(
                'where' => array(
                    array('action', '=', 'Sell' ),
                    array('option_id', '=', $model->id ),
                ),
            ));

            /*
             *   --customer balance
             * * */
            $sql = 'SELECT user_id, (SUM(debit)*-1) + SUM(credit)
                AS balance FROM balances WHERE user_id = '. $sell_transaction->user_id . ' GROUP BY user_id ';

            $last_balance = \DB::query($sql)->execute();

            $description =  'Option ID'.$model->id . ', Credit Seller';
            $balance = $last_balance[0]['balance'];
            $credit = abs( $sell_transaction->purchase );
            $balance = $balance + $credit;

            $props = array(
                'user_id' => $sell_transaction->user_id,
                'description' => $description,
                'debit' => 0,
                'credit' => $credit,
                'balance' => $balance,

            );

            Model_Balance::forge($props)->save();
        }

        /*
         * Buy, Execute, and other transactions
         *
         */

        $credit = 0;
        $debit = 0;
        $description =  'Option ID'.$model->id . ', ' . $model->status .' Action ';

        /*
         * is price positive or negative ?
         */
        if( $model->price < 0)
        {
            /*
             * Must be debit
             */
            $debit = abs( $model->price );
        }
        elseif( $model->price > 0)
        {
            /*
             * Must be credit
             */
            $credit = abs( $model->price );
        }

        /*
         *    --customer balance
         * */
        $sql = 'SELECT user_id, (SUM(debit)*-1) + SUM(credit)
                AS balance FROM balances WHERE user_id = '. $model->user_id . ' GROUP BY user_id ';

        $last_balance = \DB::query($sql)->execute();

            $description .=  ' - Debit';
            $balance = $last_balance[0]['balance'];
            $balance = $balance - $debit;
            $balance = $balance + $credit;

        $props = array(
            'user_id' => $model->user_id,
            'description' => $description,
            'debit' => $debit,
            'credit' => $credit,
            'balance' => $balance,
        );

         Model_Balance::forge($props)->save();
    }
}






