<?php 

use App\Providers\Calculator; 
use function PHPUnit\Framework\assertTrue; 

$compute = new Calculator; 

test('Addition', function ($compute) { 
    $compute->solveExpression('+', '1 + 1'); 
    expect($compute->solution)->toEqual(2); 
})->with([$compute]); 

test('Subtraction', function ($compute) { 
    $compute->solveExpression('-', '10 - 5'); 
    expect($compute->solution)->toEqual(5); 
})->with([$compute]); 

test('Multiplication', function ($compute) { 
    $compute->solveExpression('*', '5 * 5'); 
    expect($compute->solution)->toEqual(25); 
})->with([$compute]); 

test('Division', function ($compute) { 
    $compute->solveExpression('/', '21 / 3'); 
    expect($compute->solution)->toEqual(7); 
})->with([$compute]); 

test('Square Root', function ($compute) { 
    $compute->solveExpression('sqrt', '9 sqrt'); 
    expect($compute->solution)->toEqual(3); 
})->with([$compute]); 

test('Multiple Operation', function ($compute) { 
    $compute->solveExpression('multiple', '2+3*4/5'); 
    expect($compute->solution)->toEqual(4.4); 
})->with([$compute]); 

test('Validate Invalid Operands', function ($compute) { 
    $compute->solveExpression('+', 'a + a'); 
    assertTrue($compute->error); 
})->with([$compute]);
