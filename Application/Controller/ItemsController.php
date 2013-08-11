<?php
class ItemsController extends Controller
{
    protected $usesModels = array('Item', 'ItemCollection', 'NewItem');

    public function index()
    {
        return new View('json_encode_model', new ItemCollection());
    }

    public function view()
    {
        $item = new Item($this->data[0]);
        return new View('json_encode_model', $item);
    }

    public function add()
    {
        $json = $this->getPostData();

        $item = new NewItem();
        $response = $item->BuildFromJSON($json);

        if (is_numeric($response))
        {
            return new View('insert_item_success', $item, array('id' => $response));
        }
        else
        {
            return new View('insert_item_failure', $item);
        }
    }
}
