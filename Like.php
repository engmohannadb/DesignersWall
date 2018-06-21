<?
/* version 0.1 */ 
?>
<?php

if(!Isset($_GET['OID']) || !is_numeric( $_GET['OID']) || !Isset($_GET['LID']) || !Isset($_GET['UDate']) || !is_numeric( $_GET['LID']))
{
	header("Location: NotExist.php");
	
}

include("Configuration/Header.php");

session_start();
if(!isset($_SESSION["ID"])) 
header("Location: Login.php");



?>
	<h3>You like is storing.... </h3>

<?php

include("Configuration/DBInfoWriter.php");


$Result = mysql_query("SELECT `Like_Statues`  FROM `Likes` WHERE  `Liker_ID` = ". $_SESSION["ID"] ." AND  `Picture_Owner_ID` =" . $_GET['OID'] . "  AND Picture_Uploading_Date ='". $_GET['UDate'] ."'" ,$Connection);

if($Result && mysql_num_rows($Result) > 0)
{

$Result = mysql_query("UPDATE `DesignersWall`.`Likes` SET `Like_Statues` = '". $_GET['LID'] ."' WHERE 
`Likes`.`Liker_ID` ='". $_SESSION["ID"] ."' AND `Likes`.`Picture_Owner_ID` =" . $_GET['OID'] . "  AND Picture_Uploading_Date ='". $_GET['UDate'] ."'" ,$Connection);
	
 		
}
else {


$Result = mysql_query("INSERT INTO `DesignersWall`.`Likes` (`Liker_ID`,`Like_Statues`,`Picture_Owner_ID`, Picture_Uploading_Date) 
VALUES ('". $_SESSION["ID"] ."', '". $_GET['LID'] ."'," . $_GET['OID'] . ",'". $_GET['UDate'] ."'); " ,$Connection);
	
}


		header("Location: ViewPicture.php?OID=". $_GET['OID'] ."&UDate=". $_GET['UDate'] . "&Like=". $_GET['LID'] );
	 

?>

<?php

include("Configuration/Footer.php");

?>

