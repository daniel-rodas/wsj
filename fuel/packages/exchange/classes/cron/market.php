<?php

namespace Exchange\Cron;

use Exchange\Model\Coin as Model_Coin;
use Exchange\Model\Market\History as Model_History;

class Market
{
    public static function populateHistory()
    {
        $coins = Model_Coin::find('all');

        foreach($coins as $coin)
        {
            // Setup cURL request to url specified in coin (bittrex.com)
            $curl = \Request::forge($coin->api, 'curl');
            $curl->set_params(array('market' => $coin->market));

            $curl->execute();
            $curlResponse = $curl->response();

            // Return results as array
            $info = json_decode( $curlResponse->body(), true );

            // Only record market information for coin if response is successful.
            if( $info['success'] )
            {// Convert scientific notation to decimal notation
                $lastPrice = rtrim( sprintf('%.20F', $info['result']['Last'] ), '0');
                Model_History::forge(array(
                    'market' => $coin->market,
                    'coin_id' => $coin->id,
                    'last_price' =>  $lastPrice,
                    'api_url' =>  $coin->api,
                ))->save();
            }
        }
    }
}