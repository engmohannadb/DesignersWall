<?
/* version 0.1 */ 
?>
<?php
include("Header.php");

if(!isset($_GET["CID"])) 
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

    <div class="articleTitle">Delete Category:</div>
        
      <div class="articleContent">

<?php


                    include("../Configuration/DBInfoWriter.php");


$Result = mysql_query(" SELECT `ID` FROM `Pictures` WHERE Album_ID =" . $_GET["AID"]  ,$Connection);


while( $Row_Result = mysql_fetch_assoc($Result) )
{

                      $Result2 = mysql_query("DELETE FROM `DesignersWall`.`Likes` WHERE `Picture_ID` = " . $Row_Result["ID"] ,$Connection);
                   
                      $Result2 = mysql_query("DELETE FROM `DesignersWall`.`Comments` WHERE `Picture_ID` = ". $Row_Result["ID"] ,$Connection);

                      

}
     $Result = mysql_query("DELETE from `pictures` WHERE Album_ID = ". $_GET["AID"] ,$Connection);
     $Result = mysql_query("DELETE from `Category` WHERE `ID`= ". $_GET["CID"] ,$Connection);
	            			header("Location: Categories.php");

?>
    </div>

<?php
include("Footer.php");
?>
