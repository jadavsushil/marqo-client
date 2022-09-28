<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;


class HomeController extends Controller
{
    //

    public function getDocument(){
        try {
            $response = Http::get(env('HOST_URL').'indexes/my-irst-ix/documents/honey_facts_152');
            dd($response->object());
        }catch(\Throwable $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    public function addDocument(){
        $params = [
                [
                    "Title" => "data is a delectable food stuff", 
                    "Desc" => "some data boring description",
                    "_id"=> "honey_facts_152"
                ], [
                    "Title" => "new data test is a delectable food stuff",
                    "Desc" => "new mooooon! Space!!!!",
                    "_id" => "new moon_fact_153"
                ]
        ];
        try {
            $data = json_encode($params);

            $client = new Client([
                'headers' => ['Content-Type' => 'application/json']
            ]);
            $response = $client->post(env('HOST_URL').'indexes/my-irst-ix/documents?refresh=true&device=cpu', 
                    ['body' => $data]
            );
            $response = json_decode($response->getBody(), true);
            dd($response);
        }catch(\Throwable $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }


}
