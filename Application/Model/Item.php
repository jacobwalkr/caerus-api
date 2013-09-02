<?php
class Item extends Model
{
    protected $item;
    protected $usesRepositories = array('Item');

    public function __construct($id)
    {
        parent::__construct();

        $this->item = $this->repositories['Item']->FindRowById($id);
    }

    public function jsonSerialize()
    {
        return $this->item;
    }
}