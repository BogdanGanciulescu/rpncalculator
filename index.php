<?php

require('./inc/communicate.class.php');
require('./inc/rpncontainer.class.php');
require('./inc/help.class.php');
require('./inc/lineinterpretor.class.php');
require('./inc/terminator.class.php');

Communicate::showInfo("This is a rpn calculator. Enter numbers in order to get an answer.");

$stackHolder        = new RPNContainer();
$continueListening  = true;

while($continueListening) {
    
    $handle = fopen ("php://stdin","r");
    $line   = trim(fgets($handle));

    try {
        $interpretorResponse = LineInterpretor::checkLine($line,$stackHolder);

        if($interpretorResponse->Continue) {
            $ret = $stackHolder->addLine($line);

            $stackHolder->ShowResult? Communicate::showSuccess($ret) : Communicate::showInfo($ret);
        } else {
            Communicate::showInfo($interpretorResponse->Payload);
        }
        
    } catch (Exception $e) {
        Communicate::showError($e->getMessage());
    }
    

}