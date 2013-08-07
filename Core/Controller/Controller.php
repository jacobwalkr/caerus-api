<?php
class Controller
{
    public function __construct(array $data, array $query)
    {
        $this->data = $data;
        $this->query = $query;
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