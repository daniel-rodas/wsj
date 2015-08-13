<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 8/8/2015
 * Time: 12:54 AM
 */

namespace Exchange\Market;

use Exchange\Model\Coin;
use Exchange\Model\Market\History;

class Information extends Base
{
    public function get( Coin $coin )
    {
        // Setup cURL request to url specified in coin (bittrex.com)
        $curl = \Request::forge($coin->api, 'curl');
        $curl->set_params(array('market' => $coin->market));
        $curl->execute();
        $curlResponse = $curl->response();
        // Return results as array
        return json_decode( $curlResponse->body(), true );
    }

    public function getLastPrice ( $coinId )
    {
        try {
            // Run query and hope for the best.
            $history =  History::find( 'last', array(
                'where' => array(
                    array( 'coin_id','=', $coinId ),
                ),
                'order_by' => array( 'created_at' => 'desc' ),
            ));
        } catch (Orm\ValidationFailed $e) {
            // returns the individual ValidationError objects
            $errors = $e->get_fieldset()->validation()->error();
        }

        return $history->last_price;
    }

    public function getPriceHistory( $coinId, $timeFrame )
    {
        try {
            // Run query and hope for the best.
            return History::find( 'all', array(
                'where' => array(
                    array( 'coin_id', '=', $coinId ),
                    array( 'created_at', '>', $timeFrame ),
                ),
                'order_by' => array( 'created_at' => 'desc' ),
            ));
        } catch (\PhpErrorException $e) {
            // returns the individual ValidationError objects
            return $e->getMessage();
        }
    }
}
