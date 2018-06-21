<?
/* version 0.1 */ 
?>
<?php
include("Header.php");

if(!isset($_GET["AID"])) 
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

    <div class="articleTitle">Delete Administrator:</div>
        
      <div class="articleContent">

<?php

                      include("../Configuration/DBInfoWriter.php");
                      $Result = mysql_query("DELETE from `Administrators` WHERE `ID`= ". $_GET["AID"] ,$Connection);
                   
                   if($Result) {

                     	header("Location: Admins.php");
   
                        }
	            	

?>
    </div>

<?php
include("Footer.php");
?>
