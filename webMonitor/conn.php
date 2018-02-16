<?php 

define ( 'DB_HOST', '127.0.0.1' );
define ( 'DB_USER', 'root' );
define ( 'DB_PWD', 'root' );
define ( 'DB_NAME', 'air_quality' );


$SF = mysql_connect ( DB_HOST, DB_USER, DB_PWD ) or die ( "mysql_connect err");
mysql_query("SET NAMES 'UTF8'"); 
mysql_select_db ( DB_NAME, $SF ) or die ( "mysql_select_db err"); 
// mysql_close($SF);
// mysql_connect($SF);


?>
