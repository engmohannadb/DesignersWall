<?
/* version 0.1 */ 
?>
<?php
include("Header.php");

if(!isset($_GET["PID"])) 
{
		header("Location: index.php");
}

//-----------CHECK THE PERMISSION -------------
						include("../Configuration/DBInfoReader.php");
$Result = mysql_query("SELECT `User_Managment`, `Picture_Managment`, `Categories_Managment`, `Super_Managment` FROM `Administrators`
 WHERE ID =". $_SESSION["AID"],$Connection);
 
$Row_Result = mysql_fetch_assoc($Result);

if(  $Row_Result["Super_Managment"] != 1 && $Row_Result["Picture_Managment"] != 1 )  
   	header("Location: NotAllowed.php");
//------------------End Checking --------------

?>

    <div class="articleTitle">Delete Picture:</div>
        
      <div class="articleContent">

<?php


                    include("../Configuration/DBInfoWriter.php");


                    $Result = mysql_query("DELETE FROM `DesignersWall`.`Likes` WHERE `Picture_Owner_ID` =" .  $_GET["OID"] . "  AND Picture_Uploading_Date ='".  $_GET["UDate"] ."'"  ,$Connection);
                   
                   $Result = mysql_query("DELETE FROM `DesignersWall`.`Comments` WHERE `Picture_Owner_ID` =" .  $_GET["OID"] . "  AND Picture_Uploading_Date ='".  $_GET["UDate"]  ."'" ,$Connection);

                     $Result = mysql_query("DELETE from `Pictures` WHERE `Owner_ID` =" .  $_GET["OID"] . "  AND Upload_Date ='".  $_GET["UDate"]  ."'" ,$Connection);
	            			header("Location: Pictures.php");

?>
    </div>

<?php
include("Footer.php");
?>
