<?php
class View
{
    private $viewName;
    private $model;
    private $parameters;

    public function __construct($viewName, Model $model, array $parameters = array())
    {
        $this->viewName = $viewName;
        $this->model = $model;
        $this->parameters = $parameters;
    }

    public function display()
    {
        $viewActual = '?>' . file_get_contents('Application/View/' . $this->viewName . '.template.php');

        ob_start();
        eval($viewActual);
        echo ob_get_clean();
    }
}
