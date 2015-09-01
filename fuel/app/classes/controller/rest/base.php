<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 9/8/14
 * Time: 12:19 PM
 */

class Controller_Rest_Base extends \Controller_Rest
{
    protected $goodness;

    protected function internalGoodFunction()
    {
        $this->_goodness = 'Happiness';
        return $this->response($this->_goodness);
    }


    public function action_index()
    {
        $this->goodness = 'Happiness';
        return $this->response($this->goodness);
    }

    public function get_list()
    {
        return $this->response(array(
            'foo' => Input::get('foo'),
            'baz' => array(
                1, 50, 219
            ),
            'empty' => null
        ));
    }
    public function get_status_goodness()
    {
        return $this->response($this->goodness);
    }

    public function get_happy()
    {
        $this->_goodness = 'Got Happiness';
        return $this->response($this->goodness);
    }

    public function post_happy()
    {
        $this->_goodness = 'Posted Happiness';
        return $this->response($this->goodness);
    }

    public function put_happy()
    {
        $this->_goodness = 'Placed Happiness';
        return $this->response($this->goodness);
    }

    public function del_happy()
    {
        $this->_goodness = 'No Happiness';
        return $this->response($this->goodness);
    }

    public function get_section_stories($category = false)
    {

    }

}