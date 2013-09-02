<?php
class ItemRepository extends Repository
{
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
}