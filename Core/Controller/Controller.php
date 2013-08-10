<?php
class Controller
{
    protected $data;
    protected $query;

    public function __construct(array $data, array $query)
    {
        $this->data = $data;
        $this->query = $query;

        if (is_array($this->usesModels))
        {
            foreach ($this->usesModels as $useModel)
            {
                require 'Application/Model/' . $useModel . '.php';
            }
        }
    }

    public function Go($action)
    {
        // No error checking yet
        // Display view (comes from inheriting class implementing action
        $view = (strlen($action) > 0) ? $this->$action() : $this->index();

        foreach ($this->query as $key => $value)
        {
            $view->AddParameter($key, $value);
        }

        $view->Display();
    }
}
