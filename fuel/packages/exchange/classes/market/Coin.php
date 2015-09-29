<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 8/8/2015
 * Time: 12:54 AM
 */

namespace Exchange\Market;

use Exchange\Model\Coin as Model_Coin;

class Coin
{
    // TODO https://en.wikipedia.org/wiki/Fluent_interface#PHP
    protected $id;
    protected $name;
    protected $file;
    protected $alt;
    protected $api;
    protected $market;

    /*
     * @var $model will hold the value of Model\Coin
     */
    public $model;

    public function __construct()
    {
        $this->model = Model_Coin::forge();
    }

    public function set( $key, $value )
    {
//        if($this->$key)
            $this->$key = $value;
    }

    public function get( $identifier , $field = 'id' )
    {
            return $this->model = $this->model->query()->where( $field , $identifier )->get_one();
    }

    public function getAll( )
    {
            return $this->model = $this->model->query()->get();
    }

    public function create( $name, $file, $alt, $api, $market )
    {
        // TODO implement validation
        try {
            // Run query and hope for the best.
            $this->model->name = $name;
            $this->model->file = $file;
            $this->model->alt = $alt;
            $this->model->api = $api;
            $this->model->market = $market;
            $this->model->save();

            return $this->model;

        } catch (Orm\ValidationFailed $e) {
            // returns the individual ValidationError objects
            $errors = $e->get_fieldset()->validation()->error();
        }
    }
}