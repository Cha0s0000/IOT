<?php  if (($_GET['token'] == "weixin")) {
        $con = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS); 
        $data = $_GET['data'];
        mysql_select_db("app_steemitcha0s0000", $con);//要改成相应的数据库名
 
        $result = mysql_query("SELECT * FROM switch");
        while($arr = mysql_fetch_array($result)){//找到需要的数据的记录，并读出状态值
                if ($arr['ID'] == 1) {
                        $state = $arr['state'];
                }
        }

        mysql_close($con);
        echo "{".$state."}";//返回状态值，加“{”是为了帮助Arduino确定数据的位置
}else{
        echo "Permission Denied";//请求中没有type或data或token或token错误时，显示Permission Denied
}
 
?>