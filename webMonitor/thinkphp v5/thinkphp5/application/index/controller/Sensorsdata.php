<?php
namespace app\index\controller;

use think\Controller;
use think\Cookie;

class Sensorsdata extends Controller
{
    public function index()
    {
        if(cookie::has('username'))
        {
            $ID = 0;
            $dataset = db('device')->where('ID', $ID)->find();
            $data_airQuality = $dataset['data_airQuality'];
            $data_distance = $dataset['data_distance'];
            $data_voice = $dataset['data_voice'];
            $data_light = $dataset['data_light'];
            $data_humi = $dataset['data_humi'];
            $data_temp = $dataset['data_temp'];

            $data = array(
                'temp'=>$data_temp, 
                'humi'=>$data_humi,
                'light'=>$data_light, 
                'voice'=>$data_voice,
                'airquality'=>$data_airQuality, 
                'distance'=>$data_distance
            );
            return json_encode($data);
        }
            
            // return $this->fetch();
        else
            echo "您好： " . cookie('username') . ', <a href="' . url('login/loginout') . '">退出</a>';
    }   
}