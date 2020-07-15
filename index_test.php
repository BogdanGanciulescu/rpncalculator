<?php 

require('./inc/rpncontainer.class.php');
require('./inc/lineinterpretor.class.php');
require('./inc/help.class.php');

class index_test extends PHPUnit\Framework\TestCase
{
    private $Stack;
 
    protected function setUp():void
    {
        $this->Stack = new RPNContainer();
    }

    public function testReturnNumberIsInputNumber()
    {
        $result = $this->Stack->addLine('5');
        $this->assertEquals(5, $result);
    }

    public function testOperatorWithNoOperands() 
    {
        $calculator = new RPNContainer();

        $this->expectException(Exception::class);
        $calculator->addLine('+');
    }

    public function testOperationWithOneOperand() 
    {
        $calculator = new RPNContainer();

        $this->expectException(Exception::class);
        $calculator->addLine('5 +');
    }

    public function testMultipleLinesOperationWithOneOperand() 
    {
        $calculator = new RPNContainer();

        $this->expectException(Exception::class);
        $calculator->addLine('5');
        $calculator->addLine('+');
    }

    public function testAdditionOfTwoOperandsOneLine()
    {
        $calculator = new RPNContainer();

        $result = $calculator->addLine('5 5 +');
        $this->assertEquals(10, $result);
    }

    public function testAdditionOfTwoOperandsMultipleLines()
    {
        $calculator = new RPNContainer();

        $calculator->addLine('5');
        $calculator->addLine('5');
        $result = $calculator->addLine('+');

        $this->assertEquals(10, $result);
    }

    public function testMultipleOperationsSingleLine()
    {
        $calculator = new RPNContainer();

        $result = $calculator->addLine('5 5 5 8 + + -');

        $this->assertEquals(-13, $result);
    }

    public function testMultipleOperationsSingleLineThenAnotherOperationOneLine()
    {
        $calculator = new RPNContainer();

        $calculator->addLine('5 5 5 8 + + -');
        $result = $calculator->addLine('13 +');

        $this->assertEquals(0, $result);
    }

    public function testShowResultColorToBeFalse()
    {
        $calculator = new RPNContainer();

        $calculator->addLine('5');
        $this->assertFalse($calculator->ShowResult);
    }

    public function testShowResultColorToBeTrue()
    {
        $calculator = new RPNContainer();

        $calculator->addLine('5 5 +');
        $this->assertTrue($calculator->ShowResult);
    }

    public function testMultipleOperationsSingleLineThenAnotherOperationMultipleLine()
    {
        $calculator = new RPNContainer();

        $calculator->addLine('5 5 5 8 + + -');
        $calculator->addLine('13');
        $result = $calculator->addLine('+');

        $this->assertEquals(0, $result);
    }

    public function testResetOption()
    {
        $calculator = new RPNContainer();
        $calculator->addLine('5 5');
        LineInterpretor::checkLine('reset',$calculator);

        $this->expectException(Exception::class);
        $calculator->peekStack();
        
    }

    public function testShowStackOption()
    {
        $input  = '5 5';

        $calculator = new RPNContainer();
        $calculator->addLine($input);
        $output = $calculator->showstack('showstack',$calculator);

        $this->assertEquals($input,$output);
    }

    public function testShowStackOptionAfterOperation()
    {
        $input          = '5 5 5 +';
        $expectedOutput = '5 10';

        $calculator = new RPNContainer();
        $calculator->addLine($input);
        $output = $calculator->showstack('showstack',$calculator);

        $this->assertEquals($expectedOutput,$output);
    }

    public function testHelpCommand()
    {
        $expectedOutput  = "Here are the commands available: ".PHP_EOL;
        $expectedOutput .= " -reset -- resets the stack and you can take another round".PHP_EOL;
        $expectedOutput .= " -showstack -- you can see the numbers in the stack in their order".PHP_EOL;
        $expectedOutput .= " -help -- get this help message".PHP_EOL;
        $expectedOutput .= " -q -- exits the program".PHP_EOL;

        $this->assertEquals(Help::getHelp(),$expectedOutput);
    }
}