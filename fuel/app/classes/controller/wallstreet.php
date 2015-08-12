<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 8/11/2015
 * Time: 1:31 PM
 */

class Controller_Wallstreet  extends Controller
{

    public function before()
    {
        parent::before();
        Package::load('exchange');
    }

    public function action_index()
    {
        $exchange = \Exchange\Exchange::forge();

        // newOption( $optionType,  $quantity, $timeFrame, $coinId, $userId )
        $exchange->newOption( 'Call', 100 , '30m',  4, 3 );
    }
}