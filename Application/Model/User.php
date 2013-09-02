<?php

class User extends Model
{
    protected $email;
    protected $usesRepositories = array('User');

    public function __construct($email, $password)
    {
        $this->email = $email;

        if (!$repository->UserRecordExists($email))
        {
            $this->repositories['User']->CreateUserFromEmailAndPassword($email, $password);
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
