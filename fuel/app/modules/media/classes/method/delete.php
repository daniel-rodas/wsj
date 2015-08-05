<?php

namespace Media;

class Method_Delete extends Method_Template
{
	protected function template ($id = null)
	{
		if (is_null($id))
        {
            return false;
        }

		if ($model = $this->model::find($id))
		{
			$model->delete();

			return true;
		}

		else
		{
			return false;
		}

        return false;
	}
}
