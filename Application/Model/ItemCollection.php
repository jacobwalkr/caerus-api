<?php
class ItemCollection extends Model
{
    private $collection;

    public function __construct()
    {
        // Currently returns all of them
        $this->collection = array();

        $repository = new Repository('items');
        $this->collection = $repository->FetchRowsAsArray();
    }

    public function jsonSerialize()
    {
        return $this->collection;
    }
}