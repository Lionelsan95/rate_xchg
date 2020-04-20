<?php


namespace App\Service;


use Symfony\Component\HttpClient\Psr18Client;
use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;

class RestAPI
{
    public function getAPI(String $url, String $method, Array $options = []){

        // Building the final url
        $i = 0;
        foreach ($options as $key => $val){
            if($i>0)
                $url .= "&$key=$val";
            else
                $url .= "?$key=$val";
            $i++;
        }

        $client = new Psr18Client();

        $request = $client->createRequest($method, $url);
        try{
            $response = $client->sendRequest($request);
        }catch (HttpExceptionInterface $e){
            return null;
        }

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getUserIpAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}