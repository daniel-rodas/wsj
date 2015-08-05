<?php

class Method_Index extends Method_Template
{
    protected function template ( )
	{
        if ( is_array($this->data) )
        {
            // Do array stuff

            $name = strtolower($this->modelName);
            return View::forge( $name , $this->data);
        }
		$this->data[$this->modelName] = $this->model::find('all');

        return View::forge($this->modelName, $this->data);
	}
}
