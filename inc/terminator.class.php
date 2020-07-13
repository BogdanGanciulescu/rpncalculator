<?php 

class Terminator
{
    public static function terminate()
    {
        Communicate::showSuccess('bye bye');
        exit;
    }
}