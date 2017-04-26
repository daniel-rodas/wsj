<?php

/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 9/28/2016
 * Time: 9:10 PM
 */


abstract class Presenter extends \Fuel\Core\Presenter
{
    /**
     * @Rnblog
     */
    protected $blogPackage;

    public function before()
    {
        parent::before();
        $this->blogPackage = \Rodasnet\Blog\Blog::forge();
    }
}