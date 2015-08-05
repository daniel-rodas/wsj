<?php

class Observer_Wallet extends Orm\Observer
{
    public function after_insert(Orm\Model $model)
    {
        /*
         * Prepare new wallet for new users
         *
         *
         */
//        $addr = \Model_Address::find('all');
//
////        $props = array();
////        print_r($props);
////        die();
//
//
//        foreach($addr as $item)
//        {
//            $props = array(
//                'user_id' => $model->id,
//                'address_id' => $item->id,
//            );
//            Model_Wallet::forge($props)->save();
//        }
    }

    public function after_update(Orm\Model $model)
    {

    }


}






