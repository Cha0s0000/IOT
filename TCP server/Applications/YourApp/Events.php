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
          $pm_bf = "BB";
          $co_bf = "CC";
          $pwm_bf = "DD";
          $temp_bf = "EE";
          $switch_bf = "FF";
          $checkdata_bf = "GG";
          $end = "HH";


          $ID_loc = strpos($message, $ID_bf);
          $pm_loc = strpos($message, $pm_bf);
          $co_loc = strpos($message, $co_bf);
          $pwm_loc = strpos($message, $pwm_bf);
          $temp_loc = strpos($message, $temp_bf);
          $switch_loc = strpos($message, $switch_bf);
          $checkdata_loc = strpos($message, $checkdata_bf);
          $end_loc = strpos($message, $end);


          $data_ID = substr($message,$ID_loc+2,$pm_loc-$ID_loc-2);
          $data_ID = trim($data_ID);
          $data_pm = substr($message,$pm_loc+2,$co_loc-$pm_loc-2);
          $data_co = substr($message,$co_loc+2,$pwm_loc-$co_loc-2);
          $data_pwm = substr($message,$pwm_loc+2,$temp_loc-$pwm_loc-2);
          $data_temp = substr($message,$temp_loc+2,$switch_loc-$temp_loc-2);
          $data_switch = substr($message,$switch_loc+2,$checkdata_loc-$switch_loc-2);
          $data_checkdata = substr($message,$checkdata_loc+2,$end_loc-$checkdata_loc-2);
          // $data_switch_one = 1;
          // $data_switch_two = 1;
          // $data_switch_three = 1;
          // $data_switch_four = 1;
          // $data_switch_mode = 1;
          $data_switch_one = $data_switch >> 4;
          $data_switch_two = ($data_switch - $data_switch_one * 16) >> 3;
          $data_switch_three = ($data_switch - $data_switch_two * 8 - $data_switch_one * 16) >> 2;
          $data_switch_four = ($data_switch - $data_switch_two * 8 - $data_switch_one * 16 - $data_switch_three * 4) >> 1;
          $data_switch_mode = ($data_switch - $data_switch_two * 8 - $data_switch_one * 16 - $data_switch_three * 4 - $data_switch_four * 2) >> 0;

          $check_exist_sql = "SELECT * from device WHERE ID = $data_ID";
          $check_exist_result = mysql_query($check_exist_sql);
          $check_exist = mysql_num_rows($check_exist_result);              
          // =============================================================修改成query 结果=====================
          if(!$check_exist)
          {
            $insert_sql = "INSERT INTO device (ID,data_pm,data_co,data_pwm,data_temp,data_switch_one,data_switch_two,data_switch_three,data_switch_four,data_switch_mode,client_id,timestamp,online_or_not) values ('$data_ID','$data_pm','$data_co','$data_pwm','$data_temp','$data_switch_one','$data_switch_two','$data_switch_three','$data_switch_four','$data_switch_mode','$client_id','$dati','1')";
            $insert_reslut = mysql_query($insert_sql);

            $insert_pm = "INSERT into data_pm (ID,data_pm,timestamp) values ('$data_ID','$data_pm','$dati')";
            mysql_query($insert_pm);

            $insert_co = "INSERT into data_co (ID,data_co,timestamp) values ('$data_ID','$data_co','$dati')";
            mysql_query($insert_co);

            $insert_pwm = "INSERT into data_pwm (ID,data_pwm,timestamp) values ('$data_ID','$data_pwm','$dati')";
            mysql_query($insert_pwm);

            $insert_temp = "INSERT into data_temp (ID,data_temp,timestamp) values ('$data_ID','$data_temp','$dati')";
            mysql_query($insert_temp);

            $insert_switch = "INSERT into data_pm (ID,data_switch_one,data_switch_two,data_switch_three,data_switch_four,data_switch_mode,timestamp) values ('$data_ID','$data_switch_one','$data_switch_two','$data_switch_three','$data_switch_four','$data_switch_mode',$dati')";
            mysql_query($insert_switch);


          }
          else
          {
             $update_sql = "UPDATE device SET client_id = '$client_id',data_pm = '$data_pm',data_co = '$data_co',data_pwm = '$data_pwm',data_temp = '$data_temp',data_switch_one = '$data_switch_one',data_switch_two = '$data_switch_two',data_switch_three = '$data_switch_three',data_switch_four = '$data_switch_four',data_switch_mode = '$data_switch_mode',timestamp = '$dati' WHERE ID = $data_ID ";
             
             $result_update = mysql_query($update_sql);
          }

           // GateWay::sendToAll("$message\r\n");
          // Gateway::sendToAll("$client_id info\r\n ID is: $data_ID\r\n pm is :$data_pm\r\n co is : $data_co\r\n pwm is :$data_pwm\r\n temp is :$data_temp\r\n switch_1 is :$data_switch_one\r\n switch_2 is :$data_switch_two\r\n switch_3 is :$data_switch_three\r\n switch_4 is :$data_switch_four\r\n switch_mode is :$data_switch_mode\r\n checkdata is : $data_checkdata\r\n others:\r\n");
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
          // Gateway::sendToAll("$client_id say  $control_cmd");
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
