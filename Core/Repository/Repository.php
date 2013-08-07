<?php
class Repository
{
    private $db;
    private $table;

    public function __construct($table)
    {
        $this->db = System::LoadDatabaseConnector();
        $this->table = $table;
    }

    public function FindRowById($id)
    {
        $stmt = $this->db->query("SELECT * FROM $this->table LIMIT 1");

        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}