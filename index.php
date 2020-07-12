<?php
echo "This is a rpn calculator. Enter numbers in order to get an answer:";

$stack = array();
$continueListening = true;

while($continueListening) {
    
    $handle = fopen ("php://stdin","r");
    $line = fgets($handle);
    
    if(trim($line) != 'yes') {
        $stack[] = $line;

        echo $line.PHP_EOL;
    }
        
}