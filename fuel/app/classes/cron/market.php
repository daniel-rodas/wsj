<?php

namespace Cron;

class Market
{
    public static function populateHistory()
    {
        $coins = \Model_Coin::find('all');

        foreach($coins as $coin)
        {
            // Put inside history table
            $curl = \Request::forge($coin->api, 'curl');
            $curl->set_params(array('market' => $coin->market));
            $curl->execute();
            $curl = $curl->response();
            $info = json_decode($curl->body());

            \Model_Market_History::forge(array(
                'market' => $coin->market,
                'coin_id' => $coin->id,
                'last_price' => $info->result->Last,
                'api_url' =>  $coin->api,
            ))->save();
        }
    }


}