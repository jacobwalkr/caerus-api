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
            . ':reporter,null,:category,:reported_as,0,:latitude,:longitude,:radius)');

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

        if ($response === true)
        {
            return $this->db->lastInsertId();
        }
        else
        {
            trigger_error('Database error: ' . $stmt->errorInfo());
            return false;
        }
    }

    public function UserRecordExists($email)
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM `users` WHERE email=:email LIMIT 1');
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->fetchColumn() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function UserPassCorrect($email, $password)
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM `users` WHERE email=:email AND password=PASSWORD(:password) LIMIT 1');
        $stmt->execute(array(
            ':email' => $email,
            ':password' => $password
        ));

        if ($stmt->fetchColumn() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function CreateUserFromEmailAndPassword($email, $password)
    {
        $stmt = $this->db->prepare('INSERT INTO `users` (email,password) VALUES (:email,PASSWORD(:password))');
        $result = $stmt->execute(array(
            ':email' => $email,
            ':password' => $password
        ));

        if ($result == true)
        {
            return true;
        }
        else
        {
            $errorInfo = $stmt->errorInfo();
            trigger_error('Database error: ' . $errorInfo[2]);
            throw new HTTPError('Database error: could not create user', 500);
        }
    }
}
