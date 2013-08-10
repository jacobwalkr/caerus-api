<?php
class ItemCollection extends Model
{
    protected $collection;
    protected $callback;

    public function __construct($callback)
    {
        // Currently returns all of them
        $this->collection = array();
        $this->callback = $callback;

        $repository = new Repository('items');
        $this->collection = $repository->FetchRowsAsArray();
    }

    public function jsonSerialize()
    {
        return $this->collection;
    }

    public function getCallback()
    {
        return $this->callback;
    }
}
