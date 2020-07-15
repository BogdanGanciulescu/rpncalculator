<?php

class Help
{
    public static function getHelp()
    {
        $ret  = "Here are the commands available: ".PHP_EOL;
        $ret .= " -reset -- resets the stack and you can take another round".PHP_EOL;
        $ret .= " -showstack -- you can see the numbers in the stack in their order".PHP_EOL;
        $ret .= " -help -- get this help message".PHP_EOL;
        $ret .= " -q -- exits the program".PHP_EOL;

        return $ret;
    }
}