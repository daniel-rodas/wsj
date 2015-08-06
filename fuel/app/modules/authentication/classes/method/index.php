<?php

namespace Media;

class Method_Index extends Method_Template
{
    public function template ( )
	{
        if ( isset( $this->view ) )
        {
            if (isset($this->model))
            {
                die('Have Model');

//                return \Response::forge( \View::forge('frontend/post/show/image')->set($this->data, null, false) );
            }
            elseif ( isset($this->collectionModel) )
            {

//                print_r($this->collectionModel);
//                die('Have Models and Views');

                return \Response::forge( $this->view->set($this->data, null, false) );
            }

        }
        if ( is_array($this->data) )
        {
            // Do array stuff

            $name = strtolower($this->modelName);
            echo $name;
            die('Some Data');
            return \View::forge( $name , $this->data);
        }
        echo '<pre>';
        print_r($this);
        die('No Data');
//		$this->data[$this->modelName] = $this->model::find('all');

        return View::forge($this->modelName, $this->data);
	}
}
