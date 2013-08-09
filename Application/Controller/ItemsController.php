<?php
class ItemsController extends Controller
{
    protected $usesModels = array('Item', 'ItemCollection');

    public function index()
    {
        return new View('json_encode_model', new ItemCollection());
    }

    public function view()
    {
        $item = new Item($this->data[0]);
        return new View('json_encode_model', $item);
    }
}