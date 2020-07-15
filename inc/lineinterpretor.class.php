<?php

/**
 * Defines use cases for commands that are received
 */

class LineInterpretor
{
    public static function checkLine($line,$stackHolder)
    {
        $ret            = new stdClass();
        $ret->Continue  = true;
        $ret->Payload   = "";
        
        if($line == 'reset') {
            $stackHolder->clearLines();

            $ret->Continue = false;
            $ret->Payload  = "The stack was reseted!";
        }

        if($line == 'showstack') {
            $response = $stackHolder->showStack();

            $ret->Continue  = false;
            $ret->Payload   = $response;
        }

        if($line == 'help') {
            $response = Help::getHelp();

            $ret->Continue = false;
            $ret->Payload  = $response;
        }

        if($line == 'q') {
            Terminator::terminate();
        }

        return $ret;
    }
}