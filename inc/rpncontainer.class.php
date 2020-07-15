<?php

class RPNContainer
{
    private $stack      = array();
    public $ShowResult  = false;

    public function __construct()
    {
            
    }

    public function addLine($line) 
    {
        $operators   = array('-','*','/','+','=');
        $itemsInLine = explode(' ',$line);

        foreach($itemsInLine as $itemInLine) {
            //check if operator and do the math else push to stack
            if(in_array($itemInLine,$operators)) {
                if(count($this->stack) <= 1) {
                    throw new Exception('You need at least 2 operands to perform an operation');
                }
                
                $result = $this->doOperation($itemInLine);
                
                array_push($this->stack,$result);
                $this->ShowResult = true;
            } else {
                if(!is_numeric($itemInLine))
                    throw new Exception('You must enter valid numbers!');

                array_push($this->stack,$itemInLine);
                $this->ShowResult = false;
            }
        }

        return $this->peekStack();
    }

    private function doOperation($operator)
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

    /**
     * Gets the last value in stack
     * @return Exception if stack is empty
     * @return int if value is found
     */
    public function peekStack()
    {
        if(empty($this->stack)) 
            throw new Exception('The stack is empty');

        return $this->stack[(count($this->stack)-1)];
    }

    public function clearLines()
    {
        $this->stack = array();
        
        return true;
    }

    public function showStack()
    {
        if(empty($this->stack)) 
            throw new Exception('Stack is empty');
        
        $ret = "";
        $stackCopy = $this->stack;
        $stackCopyReversed = $this->reverseStack($stackCopy);

        while(count($stackCopyReversed) > 0) {
            $ret .= " ".array_pop($stackCopyReversed);
        }
        
        return trim($ret);
    }

    private function reverseStack($stackToReverse) 
    {
        $ret = array();

        while(count($stackToReverse) > 0) {
            $ret[] = array_pop($stackToReverse);
        }
        
        return $ret;
    }
}