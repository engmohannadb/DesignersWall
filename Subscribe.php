<?
/* version 0.1 */ 
?>
<?php

if(!Isset($_GET['UID']) || !is_numeric( $_GET['UID']) )
{
	header("Location: NotExist.php");
	
}

include("Configuration/Header.php");

session_start();
if(!isset($_SESSION["ID"])) 
header("Location: Login.php");



?>
	<h3>You are now subscribing.... </h3>

<?php

include("Configuration/DBInfoWriter.php");


$Result = mysql_query("SELECT `Sub_Date` FROM `Subscribes` WHERE `Subsciber_ID` = ". $_SESSION["ID"] ." AND `User_ID` = ". $_GET['UID'] ,$Connection);

if($Result && mysql_num_rows($Result) > 0)
{

$Result = mysql_query("DELETE FROM `Subscribes` WHERE `User_ID` = ". $_GET['UID'] ." AND `Subsciber_ID` = ". $_SESSION["ID"] ." ;" ,$Connection);
		header("Location: Profile.php?PID=". $_GET["UID"] . "&Subsribe=No" );	
}
else {

$Result = mysql_query("INSERT INTO `DesignersWall`.`Subscribes` (`User_ID`, `Subsciber_ID`, `Sub_Date`)
                               VALUES ( '". $_GET['UID'] ."', '". $_SESSION["ID"] ."' ,CURRENT_TIMESTAMP); " ,$Connection);
			header("Location: Profile.php?PID=". $_GET["UID"] . "&Subsribe=Yes" );
}



	 

?>

<?php

include("Configuration/Footer.php");

?>

