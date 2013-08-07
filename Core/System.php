<?php
class System
{
    public static $Database;
    private static $config;

    public static function Initialise()
    {
        self::loadConfig();
        self::$Database = self::loadDatabaseConnector();
    }

    public static function LoadService($service)
    {
        require 'Application/Model/' . $service . '.php';
        return new $service();
    }

    private static function loadConfig()
    {
        self::$config = array();

        // Only database config to consider now
        self::$config['database'] = json_decode(file_get_contents('Application/Config/database.json'));
    }

    private static function loadDatabaseConnector()
    {
        $dbConfig = self::$config['database'];
        $connector = $dbConfig->connector;
        $dbn = $dbConfig->database;
        $host = $dbConfig->host;
        $user = $dbConfig->user;
        $password = $dbConfig->password;

        $dsn = $connector . ':dbname=' . $dbn . ';host=' . $host;

        try
        {
            $pdo = new PDO($dsn, $user, $password);
        }
        catch (PDOException $exception)
        {
            error_log($exception->getMessage());
        }

        return $pdo;
    }
}