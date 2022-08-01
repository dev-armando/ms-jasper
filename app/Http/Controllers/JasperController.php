<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JasperGeneratorService as Jasper; 
use App\Services\ErpnextService as ERPNEXT; 

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



      $jasper =  new Jasper($input  , $options , 'report' ) ;
      $jasper->execute();
    

      return [ "data" => [ "path" => $jasper->getPath() . "pdf" ] ]; 

    }

    public function show($id , Request $request){

      $erpnext = new ERPNEXT(); 
      $response = $erpnext->getReportForId($id);

     
      $input = env('PRIVATE_FILES') . $response->report_file ; 

      $options = [
          'format' => $request->get('format') ?? [ 'pdf'] ,
          'params' => $request->get('params') ?? [],
   
      ];

      $jasper =  new Jasper($input  , $options , $response->report_name  ) ;
      $jasper->execute();

       return [ 
        'params' => $request->get('params') ?? [] , 
        'data' => ['url' => env('APP_URL') .'/output/' .  $response->report_name . '.pdf'] ,
        ] ;
    }

    //
}
