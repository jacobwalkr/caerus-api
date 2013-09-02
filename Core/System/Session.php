<?php

class Session
{
    protected $token;
    protected $db;

    public function __construct($token)
    {
        $this->token = $token;
        $this->db = System::LoadDatabaseConnector();
    }

    public function isActive()
    {
        //
    }
}

?>
