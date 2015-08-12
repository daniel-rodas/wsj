<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 8/11/2015
 * Time: 11:20 PM
 */

namespace Exchange\Trade;


interface IStrategy
{
    function algorithmTrade( $action );
}