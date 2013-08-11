<?php

class User extends Model
{
    protected $email;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $repository = new Repository('users');

        if (!$repository->UserRecordExists($email))
        {
            $repository->CreateUserFromEmailAndPassword($email, $password);
        }

        if ($repository->UserPassCorrect($email, $password))
        {
            // Generate token?
            throw new HTTPError('Legit free access token', 200);
        }
        else
        {
            throw new HTTPError('The password given is not correct', 401);
        }
    }

    public function jsonSerialize()
    {
        return $this->email;
    }
}

?>
