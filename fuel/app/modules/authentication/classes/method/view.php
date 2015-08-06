<?php
namespace Media;

class Method_View extends Method_Template
{
	protected function template ($id)
	{
        if (!isset($id))
        {
            return false;
        }

		$this->data[$this->modelName] = $this->model::find($id);

        return View::forge($this->modelName, $this->data);
	}
}
