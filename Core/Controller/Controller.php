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
        try
        {
            $view = (strlen($action) > 0) ? $this->$action() : $this->index();
        }
        catch (Exception $exception)
        {
            $view = new View('error_json', null, array(
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ));
        }

        foreach ($this->query as $key => $value)
        {
            $view->AddParameter($key, $value);
        }

        $view->Display();
    }

    protected function getPostData()
    {
        return @file_get_contents('php://input');
    }
}
