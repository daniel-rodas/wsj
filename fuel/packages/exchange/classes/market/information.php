<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 8/8/2015
 * Time: 12:54 AM
 */

namespace Exchange\Market;

use \Exchange\Model\Coin;

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
}
