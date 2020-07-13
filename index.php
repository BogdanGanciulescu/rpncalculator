<?php
echo "This is a rpn calculator. Enter numbers in order to get an answer:".PHP_EOL;

$stackHolder        = new RPNHolder();
$continueListening  = true;

while($continueListening) {
    
    $handle = fopen ("php://stdin","r");
    $line   = trim(fgets($handle));

    if(LineInterpretor::checkLine($line,$stackHolder))
        $stackHolder->addLine($line);

}

class RPNHolder
{
    public $stack=array();

    public function __construct()
    {
            
    }

    public function addLine($line) 
    {
        $operators   = array('-','*','/','+','=');
        $itemsInLine = explode(' ',$line);

        foreach($itemsInLine as $itemInLine) {
            //check if operator and do the math
            if(in_array($itemInLine,$operators)) {
                $showResult = true;

                if(count($this->stack) == 1) {
                    Communicate::showError('You need more operands');
                    $showResult = false;
                }

                $secondOperand  = array_pop($this->stack);
                $firstOperand   = array_pop($this->stack);
                
                $result     = eval("return ".$firstOperand.$itemInLine.$secondOperand.";");
                array_push($this->stack,$result);

                if($showResult && count($this->stack) == 1) {
                    Communicate::showSuccess("Result ".$result);
                }
                
            } else {
                //push to stack
                if(is_numeric($itemInLine)) {
                    array_push($this->stack,$itemInLine);
                    Communicate::showSuccess("> ".$itemInLine);
                } else {
                    Communicate::showError("You must enter valid numbers!");
                }
            }
        }
    }

    public function clearLines()
    {
        $this->stack = array();
        
        Communicate::showSuccess('Lines cleared');
    }

    public function showLines()
    {
        if(empty($this->stack)) {
            Communicate::showError('Stack is empty');
            return;
        }

        Communicate::showSuccess(count($this->stack)." items in stack");

        $stackCopy = $this->stack;
        while(count($stackCopy) > 0) {
            Communicate::showWarning(array_pop($stackCopy));
        }
    }
}

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

        return true;
    }
}

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
}