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

    public function CreateItemFromObject($object)
    {
        // I feel like Repository shouldn't have a method
        // this specific...
        $stmt = $this->db->prepare('INSERT INTO `items` VALUES (null,:title,:description,'
            . ':reporter,null,:category,:reported_as,null,:latitude,:longitude,:radius)');

        $response = $stmt->execute(array(
            ':title' => htmlentities($object->title),
            ':description' => htmlentities($object->description),
            ':reporter' => $object->reporter,
            ':category' => $object->category,
            ':reported_as' => $object->reported_as,
            ':latitude' => $object->latitude,
            ':longitude' => $object->longitude,
            ':radius' => $object->radius
        ));

        if ($response)
        {
            return $this->db->lastInsertId();
        }
        else
        {
            return false;
        }
    }
}
