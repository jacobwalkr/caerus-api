<?php
class Item extends Model
{
    private $item;

    public function __construct($id)
    {
        $repository = new Repository('items');
        $this->item = $repository->FindRowById($id);
    }

    public function jsonSerialize()
    {
        return $this->item;
    }
}