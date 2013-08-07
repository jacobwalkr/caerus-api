<?php
class ItemsController extends Controller
{
    protected $usesRepositories = array('item');

    public function view()
    {
        $searchId = $this->data[0];
        $item = $this->ItemRepository->FindById($searchId);
    }
}