<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JasperGeneratorService as Jasper; 

class JasperController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(){
      
       $input = "/home/erpnext/frappe-bench-armando-rojas/ms-jasper-erpnext/public/templates/example.jrxml";
       $path_data = "/home/erpnext/frappe-bench-armando-rojas/ms-jasper-erpnext/public/output/data.json";

      $options = [
          'format' => [ 'pdf'],
          'db_connection' => [
              'driver' => 'json',
              'data_file' =>  $path_data ,
              'json_query' => 'contacts.person'
          ]
      ];



      $jasper =  new Jasper($input  , $options ) ;
      $jasper->execute();
    

      return [ "data" => [ "path" => $jasper->getPath() . "pdf" ] ]; 

    }

    public function show(Request $request){

      $input = "/home/erpnext/frappe-bench-armando-rojas/ms-jasper-erpnext/public/templates/customers.jrxml";
     
      $options = [
          'format' => [ 'pdf' , 'html' , 'csv'],
          'db_connection' => [
              'driver' => 'mysql',
              'username' => env("DB_USERNAME"),
              'password' => env("DB_PASSWORD"),
              'host' => env("DB_HOST"),
              'database' => env("DB_DATABASE"),
              'port' => env("DB_PORT"),
          ],
          'params' => [],
   
      ];

      $jasper =  new Jasper($input  , $options ) ;
      $jasper->execute();


      return [ "1" , $request->all()]; 
    }

    //
}
