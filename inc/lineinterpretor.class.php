<?php

/**
 * Defines use cases for commands that are received
 */

class LineInterpretor
{
    public static function checkLine($line,$stackHolder)
    {
        if($line == 'reset') {
            $stackHolder->clearLines();

            return false;
        }

        if($line == 'showstack') {
            $stackHolder->showLines();

            return false;
        }

        if($line == 'help') {
            Help::showHelp();

            return false;
        }

        if($line == 'q') {
            Terminator::terminate();
        }

        return true;
    }
}