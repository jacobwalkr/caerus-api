<?php
class Repository
{
    protected $db;

    public function __construct($table = null)
    {
        $this->db = System::LoadDatabaseConnector();

        if (!is_string($this->table))
        {
            $this->table = $table;
        }
    }

    public function FindRowById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function FetchRowsAsArray()
    {
        $stmt = $this->db->query("SELECT * FROM $this->table");

        $resultArray = array();

        while ($row = $stmt->fetch(PDO::FETCH_OBJ))
        {
            $resultArray[] = $row;
        }

        return $resultArray;
    }
}
