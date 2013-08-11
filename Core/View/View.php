<?php
class View
{
    private $viewName;
    private $model;
    private $parameters;

    public function __construct($viewName, $model, array $parameters = array())
    {
        $this->viewName = $viewName;
        $this->model = $model;
        $this->parameters = $parameters;
    }

    public function AddParameter($key, $value)
    {
        $this->parameters[$key] = $value;
    }

    public function GetParameter($key)
    {
        return $this->parameters[$key];
    }

    public function Display()
    {
        // All results in JSON, really
        header('Content-Type: application/javascript');

        $viewActual = '?>' . file_get_contents('Application/View/' . $this->viewName . '.template.php');

        ob_start();
        eval($viewActual);
        echo ob_get_clean();
    }
}
