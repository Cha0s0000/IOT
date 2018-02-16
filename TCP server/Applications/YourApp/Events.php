<?php

use \GatewayWorker\Lib\Gateway;
include_once("conn.php"); 

class Events
{
    /**
     * 当客户端连接时触发
     * 如果业务不需此回调可以删除onConnect
     * 
     * @param int $client_id 连接id
     */
    public static function onConnect($client_id)
    {
        // 向当前client_id发送数据 
        // Gateway::sendToClient($client_id, "Hello $client_id\r\n");
        // 向所有人发送
        // Gateway::sendToAll("$client_id login\r\n");
    }
    
   /**
    * 当客户端发来消息时触发
    * @param int $client_id 连接id
    * @param mixed $message 具体消息
    */
   public static function onMessage($client_id, $message)
   {

       $header = substr($message,0,2);
       $dati = date("Y m d h:i:sa");

       // 8266上传数据
       if($header == "AA")
       {
          
          $ID_bf = "AA";
          $airQuality_bf = "BB";
          $distance_bf = "CC";
          $voice_bf = "DD";
          $light_bf = "EE";
          $humi_bf = "FF";
          $temp_bf = "GG";
          $end = "HH";


          $ID_loc = strpos($message, $ID_bf);
          $airQuality_loc = strpos($message, $pm_bf);
          $distance_loc = strpos($message, $co_bf);
          $voice_loc = strpos($message, $pwm_bf);
          $light_loc = strpos($message, $temp_bf);
          $humi_loc = strpos($message, $switch_bf);
          $temp_loc = strpos($message, $checkdata_bf);
          $end_loc = strpos($message, $end);


          $data_ID = substr($message,$ID_loc+2,$airQuality_loc-$ID_loc-2);
          $data_ID = trim($data_ID);
          $data_airQuality = substr($message,$airQuality_loc+2,$distance_loc-$airQuality_loc-2);
          $data_distance = substr($message,$distance_loc+2,$voice_loc-$distance_loc-2);
          $data_voice = substr($message,$voice_loc+2,$light_loc-$voice_loc-2);
          $data_light = substr($message,$light_loc+2,$humi_loc-$light_loc-2);
          $data_humi = substr($message,$humi_loc+2,$temp_loc-$humi_loc-2);
          $data_temp = substr($message,$temp_loc+2,$end_loc-$temp_loc-2);

          // $data_switch_one = $data_switch >> 4;
          // $data_switch_two = ($data_switch - $data_switch_one * 16) >> 3;
          // $data_switch_three = ($data_switch - $data_switch_two * 8 - $data_switch_one * 16) >> 2;
          // $data_switch_four = ($data_switch - $data_switch_two * 8 - $data_switch_one * 16 - $data_switch_three * 4) >> 1;
          // $data_switch_mode = ($data_switch - $data_switch_two * 8 - $data_switch_one * 16 - $data_switch_three * 4 - $data_switch_four * 2) >> 0;

          $check_exist_sql = "SELECT * from device WHERE ID = $data_ID";
          $check_exist_result = mysql_query($check_exist_sql);
          $check_exist = mysql_num_rows($check_exist_result);              
          // =============================================================修改成query 结果=====================
          if(!$check_exist)
          {
            $insert_sql = "INSERT INTO device (ID,data_airQuality,data_distance,data_voice,data_light,data_humi,data_temp,client_id,timestamp,online_or_not) values ('$data_ID','$data_airQuality','$data_distance','$data_voice','$data_light','$data_humi','$data_temp','$client_id','$dati','1')";
            $insert_reslut = mysql_query($insert_sql);

            // $insert_pm = "INSERT into data_pm (ID,data_pm,timestamp) values ('$data_ID','$data_pm','$dati')";
            // mysql_query($insert_pm);

            // $insert_co = "INSERT into data_co (ID,data_co,timestamp) values ('$data_ID','$data_co','$dati')";
            // mysql_query($insert_co);

            // $insert_pwm = "INSERT into data_pwm (ID,data_pwm,timestamp) values ('$data_ID','$data_pwm','$dati')";
            // mysql_query($insert_pwm);

            // $insert_temp = "INSERT into data_temp (ID,data_temp,timestamp) values ('$data_ID','$data_temp','$dati')";
            // mysql_query($insert_temp);

            // $insert_switch = "INSERT into data_pm (ID,data_switch_one,data_switch_two,data_switch_three,data_switch_four,data_switch_mode,timestamp) values ('$data_ID','$data_switch_one','$data_switch_two','$data_switch_three','$data_switch_four','$data_switch_mode',$dati')";
            // mysql_query($insert_switch);


          }
          else
          {
             $update_sql = "UPDATE device SET client_id = '$client_id',data_airQuality = '$data_airQuality',data_distance = '$data_distance',data_voice = '$data_voice',data_light = '$data_light',data_humi = '$data_humi',data_temp = '$data_temp',timestamp = '$dati' WHERE ID = $data_ID ";
             
             $result_update = mysql_query($update_sql);
          }

           // GateWay::sendToAll("$message\r\n");

       }
        
        // WEB的控制反馈给8266
        else if ($header == 'ZZ')
        {
          $client_id_bf = "ZZ";
          $action_bf = "ACTION";
          $end = "YY";
          $client_id_loc = strpos($message, $client_id_bf);
          $action_loc = strpos($message, $action_bf);
          $end_loc = strpos($message, $end);

          $device_client_id = substr($message,$client_id_loc+2,$action_loc-$client_id_loc-2);
          $device_action = substr($message,$action_loc+6,$end_loc-$action_loc-6);

          switch($device_action)
          {
            case "one_on": $control_cmd = "1";break;
            case "one_off": $control_cmd = "2";break;
            case "two_on": $control_cmd = "3";break;
            case "two_off": $control_cmd = "4";break;
            case "three_on": $control_cmd = "5";break;
            case "three_off": $control_cmd = "6";break;
            case "four_on": $control_cmd = "7";break;
            case "four_off": $control_cmd = "8";break;
            case "mode_hand": $control_cmd = "9";break;
            case "mode_auto": $control_cmd = "0";break;
            case "pwm_0": $control_cmd = "A";break;
            case "pwm_20": $control_cmd = "B";break;
            case "pwm_40": $control_cmd = "C";break;
            case "pwm_60": $control_cmd = "D";break;
            case "pwm_80": $control_cmd = "E";break;
            case "pwm_100": $control_cmd = "F";break;

          }
          Gateway::sendToAll("$client_id say  {{$control_cmd}}");
          Gateway::sendToClient($device_client_id, "{{$control_cmd}}");
        }

        //8266发送心跳包保持连接，更新ID绑定至client id
        else if($header == 'DM')
        {
          $dump_bf = "DM";
          $end_bf = "END";
          $dump_loc = strpos($message, $dump_bf);
          $end_loc = strpos($message, $end_bf);
          $dump_ID = substr($message,$dump_loc+2,$end_loc-$dump_loc-2);
          $dump_ID = trim($dump_ID);

          $dump_sql = "UPDATE device SET client_id = '$client_id' ,timestamp = '$dati' WHERE ID = $dump_ID ";
          $result_dump = mysql_query($dump_sql);            
         
        }
   }
   
   /**
    * 当用户断开连接时触发
    * @param int $client_id 连接id
    */
   public static function onClose($client_id)
   {
       // 向所有人发送 
       $close_sql = "UPDATE device set online_or_not='0' where client_id = '$client_id'";
       $result_close = mysql_query($close_sql);
       // GateWay::sendToAll("$client_id logout\r\n");
   }
}
