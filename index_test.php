<?php 

require('./inc/rpncontainernew.class.php');
require('./inc/lineinterpretor.class.php');

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
        $calculator = new RPNContainer();
        $calculator->addLine('5 5');

        LineInterpretor::checkLine('showstack',$calculator);
    }
}