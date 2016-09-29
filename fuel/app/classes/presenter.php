<?php

/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 9/28/2016
 * Time: 9:10 PM
 */
abstract class Presenter extends \Fuel\Core\Presenter
{
    protected $blogPackage;

    public function before()
    {
        parent::before();
        Package::load('Rnblog');
        $this->blogPackage = \Rnblog\Rnblog::forge();
    }
}