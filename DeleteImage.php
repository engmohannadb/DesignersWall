<?
/* version 0.1 */ 
?>
<?php
include("Configuration/Header.php");

if(!isset($_GET["UDate"])) 
{
		header("Location: index.php");
}

//-----------CHECK THE PERMISSION -------------
include("Configuration/DBInfoReader.php");

$Result = mysql_query("SELECT `File_Name`, `Owner_ID`, `Album_ID` FROM `Pictures` WHERE `Upload_Date` = '". $_GET["UDate"] ."' AND Owner_ID =". $_SESSION["ID"],$Connection);
 
$Row_Result = mysql_fetch_assoc($Result);

if ($Row_Result["Owner_ID"] != $_SESSION["ID"] )  
   	header("Location: NotExist.php");
//------------------End Checking --------------



                    include("Configuration/DBInfoWriter.php");


                      $Result2 = mysql_query("DELETE FROM `DesignersWall`.`Likes` WHERE Picture_Owner_ID = ". $_SESSION["ID"] ." AND 	Picture_Uploading_Date = '" . $_GET["UDate"] . "'" ,$Connection);
                   
                      $Result2 = mysql_query("DELETE FROM `DesignersWall`.`Comments` WHERE  Picture_Owner_ID = ". $_SESSION["ID"] ." AND 	Picture_Uploading_Date = '" . $_GET["UDate"] . "'" ,$Connection);

                      $Result2 = mysql_query("DELETE from `Pictures` WHERE Owner_ID = ". $_SESSION["ID"] ." AND 	Upload_Date = '" . $_GET["UDate"] . "'" ,$Connection);

                      unlink("UsersImages/".$_SESSION["ID"]."/".$Row_Result["File_Name"]);
                              
     
	            			header("Location: ViewAlbum.php?AID=".$Row_Result["Album_ID"] . "&DImage=OK" );


?>


<?php
include("Configuration/Footer.php");
?>
