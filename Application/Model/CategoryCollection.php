<?php
class CategoryCollection extends Model
{
    private $collection;

    public function __construct()
    {
        parent::__construct();

        $repository = new Repository('categories'); // Messy now
        $this->collection = $repository->FetchRowsAsArray();
    }

    public function jsonSerialize()
    {
        return $this->collection;
    }
}