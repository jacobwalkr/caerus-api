<?php
class ItemCollection extends Model
{
    protected $collection;

    public function __construct()
    {
        // Currently returns all of them
        $repository = new Repository('items');
        $this->collection = $repository->FetchRowsAsArray();
    }

    public function jsonSerialize()
    {
        return $this->collection;
    }
}
