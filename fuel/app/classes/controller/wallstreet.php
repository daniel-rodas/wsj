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

        $obj = $exchange->newOption( 'Future', 1100 , '30m',  4, 3 ); // WORK =]
        echo 'Congratulations here is your new option.';
        echo '<pre>';
        print_r($obj);

        // newOption( $optionType,  $quantity, $timeFrame, $coinId, $userId )
//        try {
//            // If everything goes accourding to plan you method returns new Option.
//            $obj = $exchange->newOption( $optionType,  $quantity, $timeFrame, $coinId, $userId );
//        } catch (\PhpErrorException $e) {
//            // returns the individual ValidationError objects
//            return $e->getMessage();
//        }

//        $obj = $exchange->newOption( 'Call', 355 , '30m',  13, 3 );  // NO WORK !!!
//        $obj = $exchange->newOption( 'Call', 100 , '30m',  4, 3 ); // WORK =]
//        $obj = $exchange->newOption( 'Short', 100 , '30m',  4, 3 ); // WORK =]
//        $obj = $exchange->newOption( 'Future', 100 , '30m',  4, 3 ); // WORK =]
//        $obj = $exchange->newOption( 'Sell', 100 , '30m',  4, 3 );
    }
}