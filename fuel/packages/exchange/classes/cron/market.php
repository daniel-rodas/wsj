<?php

namespace Exchange\Cron;

use Exchange\Model\Coin;
use Exchange\Model\Market\History;
use Exchange\Market\Information;

class Market
{
    public function populateHistory()
    {
        try
        {
            $coins = Coin::find('all');
        } catch (Orm\ValidationFailed $e)
        {
            // returns the individual ValidationError objects
            $errors = $e->get_fieldset()->validation()->error();
        }

        $info = new Information();
        foreach($coins as $coin)
        {
            $marketInfo = $info->get($coin);

            // Only record market information for coin if response is successful.
            if( $marketInfo['success'] )
            {// Convert scientific notation to decimal notation
                $lastPrice = rtrim( sprintf('%.20F', $marketInfo['result']['Last'] ), '0');

                try {
                    // Run query and hope for the best.
                    History::forge(array(
                        'market' => $coin->market,
                        'coin_id' => $coin->id,
                        'last_price' =>  $lastPrice,
                        'api_url' =>  $coin->api,
                    ))->save();
                        } catch (Orm\ValidationFailed $e) {
                    // returns the individual ValidationError objects
                    $errors = $e->get_fieldset()->validation()->error();
                }
            }
        }
    }
}