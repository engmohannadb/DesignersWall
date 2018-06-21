<?
/* version 0.1 */ 
?>
<?php

if(!Isset($_GET['UID']) || !is_numeric( $_GET['UID']))
{
	header("Location: NotExist.php");
	
}

include("Configuration/Header.php");

session_start();
if(!isset($_SESSION["ID"])) 
header("Location: Login.php");



?>
	<h3>We are sending your message now.... </h3>

<?php

include("Configuration/DBInfoWriter.php");

$Result = mysql_query("INSERT INTO `DesignersWall`.`Messages` (
`Sender` ,
`Reciver` ,
`Message` ,
`Read_Y_N`,
`Sending_Time`
)
VALUES (
'". $_SESSION["ID"] ."', '". $_GET['UID'] ."', '". $_POST["Message"] ."',1,
NOW()) " ,$Connection);

if($Result)
{
 		header("Location: Profile.php?PID=". $_GET["UID"] . "&Send=Yes" );
}
else {
		header("Location: Profile.php?PID=". $_GET["UID"] . "&Send=No" );
	  }

?>

<?php

include("Configuration/Footer.php");

?>

