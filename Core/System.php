<?php
static class System
{
    public static function LoadModel($model)
    {
        require 'Application/Model/' . $model . '.php';
        return new $model();
    }
}