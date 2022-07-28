<?php

namespace App\Services;

use PHPJasper\PHPJasper;

class JasperGeneratorService 
{
    
    private $output = "/home/erpnext/frappe-bench-armando-rojas/ms-jasper-erpnext/public/output/report" ;
    private $jasper; 
    private $input; 

    public function __construct($input , $options)
    {
        $this->jasper = new PHPJasper();
        $this->input = $input ; 
        $this->options = $options ; 
    }

    public function execute(){
        $this->jasper->process($this->input,$this->output,$this->options)->execute();

    }

    public function getPath(){
        return $this->output ; 
    }

    
}
