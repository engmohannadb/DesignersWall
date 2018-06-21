<?
/* version 0.1 */ 
?>

<?php

//Here you have the general coniguration to access your Database for reading only


$Connection = mysql_connect("localhost","root","");

mysql_select_db("DesignersWall",$Connection);

?>
