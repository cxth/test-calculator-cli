<?php

namespace App\Commands;

use App\Providers\Calculator;
use LaravelZero\Framework\Commands\Command;

class ComputeCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'solve {operand1?} {operator?} {operand2?}';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Calculator $calculator)
    {
        $calculator->operand1 = $this->argument('operand1'); 
        $calculator->operator = $this->argument('operator'); 
        $calculator->operand2 = $this->argument('operand2'); 
        $calculator->expression = (empty($calculator->operand1)) ? $this->ask('Enter input')  
            : $calculator->operand1 . " " . $calculator->operator . " " . $calculator->operand2; 

        $calculator->runSolve(); 
        
        if (!$calculator->error) { 
            $this->info("Solution is: " . $calculator->solution); 
        } else { 
            $this->info("Error: " . $calculator->errorMessage); 
        } 
    }

}
