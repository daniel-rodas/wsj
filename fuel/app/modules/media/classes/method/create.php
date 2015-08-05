<?php

namespace Media;

class Method_Create extends Method_Template
{
    protected function template ()
    {
        $model = $this->model::forge($this->data);

        if ($model and $model->save()) {
            return $model->id;
        }
        else
        {
           #TODO return errors
            return 'error saving thing.';
        }
        return false;
    }
}
