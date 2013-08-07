<?php
static class System
{
    public static function LoadService($service)
    {
        require 'Application/Model/' . $service . '.php';
        return new $service();
    }
}