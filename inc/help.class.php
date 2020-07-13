<?php

class Help
{
    public static function showHelp()
    {
        Communicate::showInfo("Here are the commands available: ");
        Communicate::showInfo(" -reset -- resets the stack and you can take another round");
        Communicate::showInfo(" -showstack -- you can see the numbers in the stack in their order");
        Communicate::showInfo(" -help -- get this help message");
        Communicate::showInfo(" -q -- exits the program");

    }
}