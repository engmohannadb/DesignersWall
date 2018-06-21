<?
/* version 0.1 */ 
?>
<?php


include("Configuration/Header.php");

session_start();
if(!isset($_SESSION["ID"])) 
header("Location: Login.php");



?>
	<h3>We are creating your new album.... </h3>

<?php

include("Configuration/DBInfoWriter.php");

$Result = mysql_query("INSERT INTO `DesignersWall`.`Albums` (`ID`, `Name`, `Description`, `Cretion_Date`, `Owner_ID`) 
VALUES (NULL, '". $_POST["Album_Name"] ."', '". $_POST["Description"] ."', CURRENT_TIMESTAMP, '". $_SESSION["ID"] ."'); " ,$Connection);

if($Result)
{
 		header("Location: MyProfile.php?CreateAlbum=Yes" );
}
else {
		header("Location: MyProfile.php?CreateAlbum=No" );
	  }

?>

<?php

include("Configuration/Footer.php");

?>

