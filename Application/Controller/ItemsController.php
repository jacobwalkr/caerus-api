<?php
class ItemsController extends Controller
{
    protected $usesModels = array('Item', 'ItemCollection');

    public function index()
    {
        $parameters = array('callback' => $this->query['callback']);
        return new View('json_encode_model', new ItemCollection(), $parameters);
    }

    public function view()
    {
        $item = new Item($this->data[0]);
        return new View('json_encode_model', $item);
    }
}
