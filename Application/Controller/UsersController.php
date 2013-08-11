<?php

class UsersController extends Controller
{
    protected $usesModels = array('User');

    public function login()
    {
        $loginObject = json_decode($this->getPostData());
        //var_dump($loginObject);
        $email = $loginObject->email;
        $password = $loginObject->password;

        $user = new User($email, $password);

        return new View('user_auth', $user);
    }
}
