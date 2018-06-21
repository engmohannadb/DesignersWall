<?
/* version 0.1 */ 
?>
<?php
include("Header.php");

if(!isset($_GET["UID"])) 
{
		header("Location: index.php");
}

//-----------CHECK THE PERMISSION -------------
						include("../Configuration/DBInfoReader.php");
$Result = mysql_query("SELECT `User_Managment`, `Picture_Managment`, `Categories_Managment`, `Super_Managment` FROM `Administrators`
 WHERE ID =". $_SESSION["AID"],$Connection);
 
$Row_Result = mysql_fetch_assoc($Result);

if(  $Row_Result["Super_Managment"] != 1 && $Row_Result["User_Managment"] != 1 )  
   	header("Location: NotAllowed.php");
//------------------End Checking --------------

?>

    <div class="articleTitle">Delete User:</div>
        
      <div class="articleContent">

<?php


                    include("../Configuration/DBInfoWriter.php");

                      $Result = mysql_query("DELETE FROM `DesignersWall`.`Likes` WHERE `Likes`.`Liker_ID` = ". $_GET["UID"] ,$Connection);
                   
                      $Result = mysql_query("DELETE FROM `DesignersWall`.`Comments` WHERE Writer_ID = ". $_GET["UID"] ,$Connection);

                      $Result = mysql_query("DELETE from `Pictures` WHERE `Owner_ID`= ". $_GET["UID"] ,$Connection);
                                      
                      $Result = mysql_query("DELETE from `Albums` WHERE `Owner_ID`= ". $_GET["UID"] ,$Connection);

                      $Result = mysql_query("DELETE from `Messages` WHERE `Sender`= ". $_GET["UID"] . " OR Reciver = ". $_GET["UID"] ,$Connection);

         $Result = mysql_query("DELETE from `Subscribes` WHERE `User_ID`= ". $_GET["UID"] . " OR `Subsciber_ID` = ". $_GET["UID"] ,$Connection);
 

                      $Result = mysql_query("DELETE from `Users` WHERE `ID`= ". $_GET["UID"] ,$Connection);
                   
	            			header("Location: Users.php");

?>
    </div>

<?php
include("Footer.php");
?>
