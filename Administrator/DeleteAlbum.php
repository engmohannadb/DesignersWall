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
$Result = mysql_query("SELECT `Grant_User_Manage`, `Grant_Picture_Manage`, `Grant_Category_Manage`, `Grant_Super_Manage` FROM `administrators`
 WHERE ID =". $_SESSION["AID"],$Connection);
 
$Row_Result = mysql_fetch_assoc($Result);

if ($Row_Result["Grant_Super_Manage"] != 1)  
   	header("Location: NotAllowed.php");
//------------------End Checking --------------

?>

    <div class="articleTitle">Delete Album:</div>
        
      <div class="articleContent">

<?php


                    include("../Configuration/DBInfoWriter.php");


$Result = mysql_query(" SELECT `Owner_ID` , `Upload_Date`  FROM `Pictures` WHERE Album_ID =" . $_GET["AID"]  ,$Connection);


while( $Row_Result = mysql_fetch_assoc($Result) )
{

                      $Result2 = mysql_query("DELETE FROM `DesignersWall`.`Likes` WHERE `Picture_Owner_ID` =" .  $Row_Result["Owner_ID"] . "  AND Picture_Uploading_Date ='".  $Row_Result["Upload_Date"] ."'"  ,$Connection);
                   
                      $Result2 = mysql_query("DELETE FROM `DesignersWall`.`Comments` WHERE `Picture_Owner_ID` =" .  $Row_Result["Owner_ID"] . "  AND Picture_Uploading_Date ='".  $Row_Result["Upload_Date"] ."'" ,$Connection);

                      

}
     $Result = mysql_query("DELETE from `Pictures` WHERE Album_ID = ". $_GET["AID"] ,$Connection);
     $Result = mysql_query("DELETE from `Albums` WHERE `ID`= ". $_GET["AID"] ,$Connection);
	            			header("Location: Albums.php");

?>
    </div>

<?php
include("Footer.php");
?>
