<?php 

class Communicate
{
    public static function showError($message)
    {
        echo PHP_EOL."\e[31m".$message."\e[0m".PHP_EOL;
    }

    public static function showSuccess($message)
    {
        echo "\e[92m".$message."\e[0m".PHP_EOL;
    }

    public static function showWarning($message)
    {
        echo "\e[93m".$message."\e[0m".PHP_EOL;
    }

    public static function showInfo($message)
    {
        echo "\e[94m".$message."\e[0m".PHP_EOL;
    }
}