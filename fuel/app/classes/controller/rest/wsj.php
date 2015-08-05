<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 9/8/14
 * Time: 12:19 PM
 */

class Controller_Rest_Wsj extends \Controller_Rest
{
    protected $_goodness;


    protected function _switch($arrayOrCase, $return, $value, $default = null )
    {
        if(is_array($arrayOrCase))
        {
            $_switch = 'switch(' . $value . '){ \n';
            foreach($arrayOrCase as $case)
            {
                $_switch .= ' case \'' . $case . '\': \n';
                $_switch .= ' return ' . $case->return . '; \n';
            }
            $_switch .= 'default: \n return' . $default;
            $_switch .= '\n }';

        }
        else
        {
            $_switch = 'switch(' . $value . '){ \n';


                $_switch .= ' case \'' . $arrayOrCase . '\': \n';
                $_switch .= ' return ' . $return . '; \n';

            $_switch .= 'default: \n return' . $default;
            $_switch .= '\n }';
        }

        return $_switch();

    }


    protected function _internalGoodFunction()
    {
        $this->_goodness = 'Happiness';
        return $this->response($this->_goodness);
    }


    public function action_index()
    {
        $this->_goodness = 'Happiness';
        return $this->response($this->_goodness);
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
        return $this->response($this->_goodness);
    }

    public function get_happy()
    {
        $this->_goodness = 'Got Happiness';
        return $this->response($this->_goodness);
    }

    public function post_happy()
    {
        $this->_goodness = 'Posted Happiness';
        return $this->response($this->_goodness);
    }

    public function put_happy()
    {
        $this->_goodness = 'Placed Happiness';
        return $this->response($this->_goodness);
    }

    public function del_happy()
    {
        $this->_goodness = 'No Happiness';
        return $this->response($this->_goodness);
    }

    public function get_section_stories($category = false)
    {
//
//        return $this->response(array(
//            'foo' => Input::get('category'),
//            'baz' => array(
//                1, 50, 219
//            ),
//            'empty' => null
//        ));
//        Input::get('foo');
        $category = \Module\Blog\Model_Category::query()->where('slug', Input::get('category'))->get_one();
        echo '<pre>';
        print_r($category);
        die();

        if ( ! $category)
        {
            return $this->response($data = array(), 404);
        }
        else
        {

            // Get posts
            return $this->response = Model_Post::query()
                ->where('category_id', $category->id)
                ->order_by('created_at', 'DESC')
                ->limit(4)
                ->get();
        }
    }

}