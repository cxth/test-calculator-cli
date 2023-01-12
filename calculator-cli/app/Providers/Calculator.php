<?php

namespace App\Providers; 

use jlawrence\eos\Parser; 
use Throwable; 

class Calculator 
{ 
    /** 
     * The allowed operations. 
     * 
     * @var array 
     */ 
    protected $allowedOperations = []; 

    /** 
     * The mathematical expression for evaluation. 
     * 
     * @var string 
     */ 
    public $expression = null; 

    /** 
     * The first operand on the mathematical expression 
     * 
     * @var mixed 
     */ 
    public $operand1 = null; 

    /** 
     * The mathematical operation on the expression 
     * 
     * @var string 
     */ 
    public $operator = null; 

    /** 
     * The second operand on the mathematical expression 
     * 
     * @var string 
     */ 
    public $operand2 = null; 

    /** 
     * The solution of the mathematical expression 
     * 
     * @var string 
     */ 
    public $solution = null; 

    /** 
     * The error 
     * 
     * @var boolean 
     */ 
    public $error = false; 

    /** 
     * The error message 
     * 
     * @var string 
     */ 
    public $errorMessage = null; 

    /** 
     * The description of the command. 
     * 
     * @var string 
     */ 
    protected $description = 'Take operands and operator'; 

    /** 
     * Perform addition operation 
     *  
     * @param array $operands 
     * @return void or Throwable 
     */ 
    public function performAddition($operands) {       
        try { 
            $this->solution = $operands[0] + $operands[1]; 
        } catch (Throwable $t) { 
            $this->error = true; 
            $this->errorMessage = "Invalid expression: " . $t->getMessage(); 
        } 
    } 

    /** 
     * Perform subtraction operation 
     *  
     * @param array $operands 
     * @return void or Throwable 
     */ 
    public function performSubtraction($operands) { 
        try { 
          $this->solution = $operands[0] - $operands[1]; 
        } catch (Throwable $t) { 
          $this->error = true; 
          $this->errorMessage = "Invalid expression: " . $t->getMessage(); 
        } 
    } 

    /** 
     * Perform multiplication operation 
     *  
     * @param array $operands 
     * @return void or Throwable 
     */ 
    public function performMultiplication($operands) { 
        try { 
            $this->solution = $operands[0] * $operands[1]; 
        } catch (Throwable $t) { 
            $this->error = true; 
            $this->errorMessage = "Invalid expression: " . $t->getMessage(); 
        } 
    } 

    /** 
     * Perform division operation 
     *  
     * @param array $operands 
     * @return void or Throwable 
     */ 
    public function performDivision($operands) { 
        try { 
            $this->solution = $operands[0] / $operands[1]; 
        } catch (Throwable $t) { 
            $this->error = true; 
            $this->errorMessage = "Invalid expression: " . $t->getMessage(); 
        } 
    } 

    /** 
     * Get square root of a number 
     *  
     * @param array $operands 
     * @return void or Throwable 
     */ 
    public function performSquareRoot($number) { 
        try { 
            $this->solution = sqrt($number[0]); 
        } catch (Throwable $t) { 
            $this->error = true; 
            $this->errorMessage = "Invalid expression: " . $t->getMessage(); 
        } 
    } 

    /** 
     * Evaluate a methematical expression using jlawrence11/eos package.  
     *  
     * @param string $expression 
     * @return void or Throwable 
     */ 
    public function performMultipleOperation($expression) { 
        try { 
            $this->solution = Parser::solve($expression); 
        } catch (Throwable $t) { 
            $this->error = true; 
            $this->errorMessage = "Invalid expression: " . $t->getMessage(); 
        } 
    } 

    /** 
     * Extract operands from an expression 
     *  
     * @param string $operator 
     * @param string $expression 
     */ 
    public function getOperands($operator, $expression)  
    { 
        return explode($operator, $expression); 
    } 
    
    /** 
     * Return solution for a mathematical expression given an operation 
     *  
     * @param string $operation 
     * @param string $expression 
     */ 
    public function solveExpression($operation, $expression) 
    { 
        switch ($operation) { 
            case '+': 
                return $this->performAddition($this->getOperands('+', $expression)); 
                break; 
            case '-': 
                return $this->performSubtraction($this->getOperands('-', $expression)); 
                break; 
            case '*': 
                return $this->performMultiplication($this->getOperands('*', $expression)); 
                break; 
            case '/': 
                return $this->performDivision($this->getOperands('/', $expression)); 
                break; 
            case 'sqrt': 
                return $this->performSquareRoot($this->getOperands('sqrt', $expression)); 
                break; 
             
            case 'multiple': 
                return $this->performMultipleOperation($expression); 
                break; 
        } 
    } 
    /** 
     * Solve the math expression 
     * 
     * @return void 
     */ 
    public function runSolve() 
    { 
        // list all allowed operations 
        $this->allowedOperations = ['+', '-', '*', '/', 'sqrt']; 
        // check the expression for allowed operations 
        $operations = []; 
        for ($i = 0; $i < count($this->allowedOperations); $i++) { 
            $operations[] = strpos($this->expression, $this->allowedOperations[$i]); 
        } 
        // get all found operations 
        $foundOperations = array_filter($operations, function($x) { return !empty($x); }); 
        if (count($foundOperations) < 2) { 
            $this->solveExpression($this->allowedOperations[key($foundOperations)], $this->expression); 
        } else { 
            // use eos package for multi math operation 
            $this->solveExpression('multiple', $this->expression); 
        } 
    } 
}