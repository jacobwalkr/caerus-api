<?php
class UserRepository extends Repository
{
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