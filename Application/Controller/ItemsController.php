<?php
class ItemsController extends Controller
{
    protected $usesModels = array('Item');

    public function view()
    {
        $item = new Item($this->data[0]);
        return new View('item', $item);
    }
}