<?php
class Controller
{
    public function __construct(array $data, array $query)
    {
        $this->data = $data;
        $this->query = $query;

        if (is_array($this->usesRepositories))
        {
            foreach ($this->usesRepositories as $useRepository)
            {
                $repositoryName = ucfirst(strtolower($useRepository)) . 'Repository';
                require 'Application/Repository/' . $repositoryName . '.php';

                $this->$repositoryName = new $repositoryName();
            }
        }
    }

    public function Go($action)
    {
        // No error checking yet
        if (strlen($action) > 0)
        {
            $this->$action();
        }
        else
        {
            $this->index();
        }
    }
}