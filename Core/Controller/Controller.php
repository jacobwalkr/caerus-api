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
        try
        {
            if (strlen($action) > 0)
            {
                if (method_exists(this, $action))
                {
                    $view = $this->$action();
                }
                else
                {
                    throw new Exception("The action '$action' does not exist.", 404)
                }
            }
            else
            {
                $view = $this->index();
            }
        }
        catch (Exception $exception)
        {
            // Process error
        }

        $view->display();
    }

    protected function name()
    {

    }
}