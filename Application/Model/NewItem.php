<?php

class NewItem extends Model
{
    private $repository;
    private $json;

    public function __construct()
    {
        $this->repository = new Repository('items');
    }

    public function BuildFromJSON($json)
    {
        $object = json_decode($json);

        // Validation!
        if (is_string($object->title)
            && strlen($object->title) < 256
            && is_string($object->description)
            && strlen($object->description) < 2001
            && is_int($object->reporter)
            && is_int($object->category)
            && in_array($object->reported_as, ['lost', 'found'], true)
            && is_numeric($object->latitude)
            && is_numeric($object->longitude))
        {
            if (!is_int($object->radius))
            {
                $object->radius = 150;
            }

            $response = $this->repository->CreateItemFromObject($object);
            $this->json = new stdClass();

            if (is_numeric($response))
            {
                $this->json->id = $response;
            }
            else
            {
                $this->json->error = new stdClass();
                $this->json->error->code = 500;
                $this->json->error->message = 'Database error - could not insert item';
            }

            return $response;
        }
    }

    public function jsonSerialize()
    {
        return $this->json;
    }
}
?>
