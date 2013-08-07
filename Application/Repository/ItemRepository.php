<?php
class ItemRepository
{
    private $db;

    public function __construct()
    {
        $this->db = System::LoadDatabaseConnector();
    }

    public function FindById($id)
    {
        $stmt = $this->db->query('SELECT * FROM items LIMIT 1');

        print_r($stmt->fetch(PDO::FETCH_ASSOC));
    }
}