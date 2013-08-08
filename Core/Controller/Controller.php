<?php
class Controller
{
    public function __construct(array $data, array $query)
    {
        $this->data = $data;
        $this->query = $query;

        if (is_array($this->usesModels))
        {
            foreach ($this->usesModels as $useModel)
            {
                $modelName = ucfirst(strtolower($useModel));
                require 'Application/Model/' . $modelName . '.php';
            }
        }
    }

    public function Go($action)
    {
        // No error checking yet
        // Display view (comes from inheriting class implementing action
        $view = (strlen($action) > 0) ? $this->$action() : $this->index();
        $view->display();
    }
}