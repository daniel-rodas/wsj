<?php

namespace Media;


abstract class Method_Template
{
    protected $model;
    protected $collectionModel = array();
    protected $collectionModelName = array();
    protected $view;
    protected $data;
    protected $modelName;

    function __construct( $model, $view = false,  array $data = null )
    {

        if (is_array($model))
        {
            foreach($model as $key => &$modelObj)
            {
                $this->collectionModel[$key] = $modelObj;
                $this->collectionModelName[$key] = get_class($modelObj);
            }
        }
        else
        {
            $this->model = $model;
            $this->modeName = get_class($this->model);
        }

        isset($view) ? $this->view = $view : null;
        isset($data) ? $this->data = $data : null;
    }

    abstract protected function template ();

    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return  $this->model;
    }

    public function setView(View $view)
    {
        $this->view = $view;
    }

    public function getView()
    {
        return $this->view;
    }

    public function setData(array $array)
    {
        $this->data = $array;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setModelName(string $name)
    {
        $this->modelName = $name;
    }

    public function getModelName()
    {
        return $this->modelName;
    }

    /**
     * Gets a new instance of the Method class.
     *
     * @param   string      The name or instance of the Method to link to
     * @return  Method
     */
    public static function forge($method = 'default')
    {
        if (is_string($method))
        {
            ($set = \Method::instance($method)) and $method = $set;
        }

        if ($method instanceof Method_Template)
        {
            if ($method->template(false) != null)
            {
                throw new \DomainException('Form instance already exists, cannot be recreated. Use instance() instead of forge() to retrieve the existing instance.');
            }
        }

        return new static($method);
    }

    public static function instance($name = null)
    {
        $method = \Method_Template::instance($name);
        return $method === false ? false : $method->tempate();
    }
}
