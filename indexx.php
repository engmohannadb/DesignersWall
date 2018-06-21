<?
/* version 0.1 */ 
?>
<?php
if(isset($_GET["go"]))
if($_GET["go"]== "logout")
{
   session_start();
	session_destroy();	
}

include("Configuration/Header.php");

?>



<?php

include("Configuration/Footer.php");

?>




