<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 8/8/2015
 * Time: 12:54 AM
 */

namespace Exchange\Market;

use Exchange\Model\Market\History;

class Information extends Base
{
    public static function get( Coin $coin )
    {
        $curl = \Request::forge($coin->api, 'curl');
        $curl->set_params(array('market' => $coin->market));
        $curl->execute();
        $curl = $curl->response();
        return $info = json_decode($curl->body());
    }

    public function getLastPrice ( $coinId )
    {
        $history =  History::find( 'last', array(
            'where' => array(
                array( 'coin_id','=', $coinId ),
            ),
            'order_by' => array( 'created_at' => 'desc' ),
        ));

        return $history->last_price;
    }

    public function getPriceHistory( $coinId, $timeFrame )
    {
        return History::find( 'all', array(
            'where' => array(
                array( 'coin_id', '=', $coinId ),
                array( 'created_at', '>', $timeFrame ),
            ),
            'order_by' => array( 'created_at' => 'desc' ),
        ));
    }
}
