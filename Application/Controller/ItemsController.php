<?php
class ItemsController extends Controller
{
    protected $usesModels = array('Item');

    public function view()
    {
        $searchId = $this->data[0];

        // This should be model code
        $repository = new Repository('items');
        $item = $repository->FindRowById($searchId);

        $item->resolved = $item->resolved ? true : false;
        // End disgusting model code

        return new View('item', $item);
    }
}