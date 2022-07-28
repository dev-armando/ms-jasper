<?php

namespace App\Services;

use PHPJasper\PHPJasper;

class JasperGeneratorService 
{
    
    private $output = "/home/erpnext/frappe-bench-armando-rojas/ms-jasper-erpnext/public/output/report" ;
    private $jasper; 
    private $input; 

    public function __construct($input , $options )
    {
        $this->jasper = new PHPJasper();
        $this->input = $input ; 
        $this->options = $options ; 
        $this->options['db_connection'] = $this->getConnection();
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
