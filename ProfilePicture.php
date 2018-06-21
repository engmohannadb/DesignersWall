<?
/* version 0.1 */ 
?>
<?php
 

if(!Isset($_GET['UID']) || !is_numeric( $_GET['UID']))
{
	header("Location: NotExist.php");
}

include("Configuration/DBInfoReader.php");

$Result = mysql_query("SELECT Picture From users Where ID = ". $_GET['UID'],$Connection);

$Row_Result = mysql_fetch_assoc($Result);
 header("Content-type: image/jpeg");
print $Row_Result["Picture"] ;


?>
