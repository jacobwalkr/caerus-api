<?php
class Controller
{
    public function __construct(array $data, array $query)
    {
        $this->data = $data;
        $this->query = $query;

        /*if (is_array($this->usesModels))
        {
            foreach ($this->usesModels as $useRep)
            {
                $modelName = ucfirst(strtolower($useModel)) . 'Repository';
                require 'Application/Repository/' . $modelName . '.php';

                $this->$modelName = new $modelName();
            }
        }*/
    }

    public function Go($action)
    {
        // No error checking yet
        // Display view (comes from inheriting class implementing action
        $view = (strlen($action) > 0) ? $this->$action() : $this->index();
        $view->display();
    }
}