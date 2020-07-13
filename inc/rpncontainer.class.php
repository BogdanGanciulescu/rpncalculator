<?php

class RPNContainer
{
    private $stack=array();

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

                $result = $this->doMath($itemInLine);
                
                array_push($this->stack,$result);

                $append = "Partial result ";
                if($showResult && count($this->stack) == 1)
                    $append = "Final result ";
                
                Communicate::showSuccess($append.$result);
                
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

    private function doMath($operator)
    {
        $secondOperand  = array_pop($this->stack);
        $firstOperand   = array_pop($this->stack);

        switch($operator){
            case '+':
                $result = $firstOperand + $secondOperand;
                break;
            case '-':
                $result = $firstOperand - $secondOperand;
                break;
            case '*':
                $result = $firstOperand * $secondOperand;
                break;
            case '/':
                $result = $firstOperand / $secondOperand;
                break;
        }
        
        return $result;
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