<?php

namespace Exchange\Observer;

class Transaction extends \Orm\Observer
{
    public function after_insert(\Orm\Model $model)
    {
        /*
         * Using a static method
         * Send cURL request to crypto currency market API
         */
        $info = \Exchange\Market\Base::getMarketInfo($model->coins);
        list(, $userId) = \Auth::get_user_id();
        $trans_props = array(
            'user_id' => $userId,
            'option_id' => $model->id,
            'action' => $model->status,
            'purchase' => $model->price,
            'market' => $info->result->Last,
        );

        return \Exchange\Model\Transaction::forge($trans_props)->save();
    }

    public function after_update(\Orm\Model $model)
    {
        /*
         * Using a static method
         * Send cURL request to crypto currency market API
         */
        $info = \Exchange\Market\Information::get($model->coins);

        die($info);
        list(, $userId) = \Auth::get_user_id();
        $trans_props = array(
            'user_id' => $userId,
            'option_id' => $model->id,
            'action' => $model->status,
            'purchase' => $model->price,
            'market' => $info->result->Last,
        );

        return \Exchange\Model\Transaction::forge($trans_props)->save();
    }
}






