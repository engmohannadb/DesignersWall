<?
/* version 0.1 */ 
?>
<?php
include("Header.php");

if(!isset($_GET["DID"])) 
{
		header("Location: index.php");
}

//-----------CHECK THE PERMISSION -------------
include("../Configuration/DBInfoReader.php");
$Result = mysql_query("SELECT `User_Managment`, `Picture_Managment`, `Categories_Managment`, `Super_Managment` FROM `Administrators`
 WHERE ID =". $_SESSION["AID"],$Connection);
 
$Row_Result = mysql_fetch_assoc($Result);

if(  $Row_Result["Super_Managment"] != 1 || $Row_Result["Categories_Managment"] != 1 )  
   	header("Location: NotAllowed.php");

?>

    <div class="articleTitle">Delete design program:</div>
        
      <div class="articleContent">

<?php


                    include("../Configuration/DBInfoWriter.php");


     $Result = mysql_query("DELETE from `Design_Programs` WHERE `ID`= ". $_GET["DID"] ,$Connection);
	            			header("Location: Dprogram.php");

?>
    </div>

<?php
include("Footer.php");
?>
