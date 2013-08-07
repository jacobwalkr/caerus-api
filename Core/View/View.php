<?php
class View
{
    private $viewName;
    private $model;

    public function __construct($viewName, $model)
    {
        $this->viewName = $viewName;
        $this->model = $model;
    }

    public function display()
    {
        $viewActual = '?>' . file_get_contents('Application/View/' . $this->viewName . '.template.php');

        ob_start();
        eval($viewActual);
        echo ob_get_clean();
    }
}