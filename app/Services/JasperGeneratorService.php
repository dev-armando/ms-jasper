<?php

namespace App\Services;

use PHPJasper\PHPJasper;

class JasperGeneratorService 
{
    
    private $output  ;
    private $jasper; 
    private $input; 

    public function __construct($input , $options , $name )
    {
        $this->jasper = new PHPJasper();
        $this->input = $input ; 
        $this->options = $options ; 
        $this->options['db_connection'] = $this->getConnection();
        $this->output = env('OUTPUT_FILES') . '/' . $name; 
    }

    public function execute(){
        $this->jasper->process($this->input,$this->output,$this->options)->execute();

    }

    public function getPath(){
        return $this->output ; 
    }

    public function getConnection(){
        return  [
            'driver' => env("DB_CONNECTION"),
            'username' => env("DB_USERNAME"),
            'password' => env("DB_PASSWORD"),
            'host' => env("DB_HOST"),
            'database' => env("DB_DATABASE"),
            'port' => env("DB_PORT"),
        ];
    }

    
}
