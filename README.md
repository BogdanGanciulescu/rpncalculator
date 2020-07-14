# PHP simple RPN calculator

PHP simple RPN calculator is a CLI tool that proves the basic principles of the Reversed Polish Notation. RPN  is a mathematical notation in which operators follow (postfix) their operands and was invented by the logician Jan Łukasiewicz in 1924.
RPN is evaluated using a stack:
* if a value appears next in the expression, push this value on to the stack. 
* if an operator appears next, pop two items from the top of the stack and push the result of the operation on to the stack.

## Features

* add the numbers and operators in the desired order and get a result.
* you can reset the stack build at any point by using the 'reset' command.
* you can see the entire stack by using the 'showstack' command.
* you can exit the program by using the 'q' command.
* you can see all the commands above using the 'help' command.

## Requirements

* PHP 5.3+

## Installation

* Simply clone the repository, navigate into the folder and execute
``` php index.php ```

## Usage examples

``` 
3 3 2 * + 
> 3
> 3
> 2
Partial result 6
Final result 9
```

``` 
reset
Lines cleared
```

``` 
4
> 4
3
> 3
+
Final result 7
2 -
> 2
Final result 5
```

## TO DO

* use the calculator to interpret an ecuation written with infix notion and solve it using reversed polish notation (implementing shunting-yard algorithm );
* add operations: power, square root.

