<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 8/11/2015
 * Time: 11:20 PM
 */

namespace Exchange;


interface IStrategy
{
    function algorithmTrade( $option );
}