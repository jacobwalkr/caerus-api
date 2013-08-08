<?php
class Item extends Model
{
    public function __construct($id)
    {
        $repository = new Repository('items');
        $this->item = $repository->FindRowById($id);
        $this->item->resolved = $this->item->resolved ? true : false;
    }

    public function __get($var)
    {
        return $this->item->$var;
    }
}