<?php
class ItemCollection extends Model
{
    protected $collection;
    protected $usesRepositories = array('Item');

    public function __construct()
    {
        $this->collection = $this->repositories['Item']->FetchRowsAsArray();
    }

    public function jsonSerialize()
    {
        return $this->collection;
    }
}
