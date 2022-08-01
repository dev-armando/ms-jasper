<?php

namespace App\Services;
use Httpful\Request as Http;

class ErpnextService 
{
    
    private $url ;

    public function __construct()
    {
      $this->url = env('URL_API'); 


    }

    public function execute($path){

        $response = Http::get( $this->url . '/resource' . $path )
        ->addHeaders($this->getHeader())
        ->expectsJson()
        ->send();

      
        return $this->setResponseErpnext($response); 
    }

    public function getReportForId($id){
        return $this->execute('/Report%20Jaspert/'.$id) ;
    }

    protected function setResponseErpnext($response){
       return json_decode(json_encode($response->body->data)); 
    }

    protected function getHeader(){
        return [
            'content-type' => "application/json",
            'Authorization' => "Basic " . base64_encode(  env('API_KEY') . ':' .   env('API_KEY_SECRET') )
        ];
    }

}
