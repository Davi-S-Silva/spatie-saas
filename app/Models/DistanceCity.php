<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class DistanceCity extends Model
{
    private $base_endpoint = "https://api.mapbox.com/directions/v5/mapbox/driving/";
    private $token = "pk.eyJ1IjoiZGF2aXNhbnRvcyIsImEiOiJjbHZ0c2RzMnIxYnJmMnFxaTl6dTc2ZzJ6In0.ppW3lzsXsufBLQYav79HBg";
    private  $result;
    public function __construct($origem, $destino){
        $url = $this->base_endpoint .$origem.";".$destino."?access_token=".$this->token ;
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            // Permite obter o resultado
            CURLOPT_RETURNTRANSFER => 1,
        ]);
        $resposta = json_decode(curl_exec($ch), true);
        curl_close($ch);
        return $this->result = (object)$resposta;
    }
    public function showDistance(){
        // return $this->result->routes[0];
        return ($this->result->routes[0]['distance']/1000);
    }
    public function showWaypoints(){
        $arr = ['origem'=>$this->result->waypoints[0]['name'], 'destino'=>$this->result->waypoints[1]['name']];
        return (object)$arr;
    }

    public function showDuration(){
        return (($this->result->routes[0]['duration']/60)/60);
    }
}
