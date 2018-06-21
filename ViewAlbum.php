<?
/* version 0.1 */ 
?>
<?php

include("Configuration/Header.php");

if(!Isset($_GET['AID']) || !is_numeric( $_GET['AID']))
{
	header("Location: index.php");
}
else
 {
 	
include("Configuration/DBInfoReader.php");

$Result = mysql_query("SELECT Name,Owner_ID From Albums Where ID = ". $_GET['AID'],$Connection);

if(mysql_num_rows($Result) > 0)
{
$Row_Result = mysql_fetch_assoc($Result); 
echo "<h3>".$Row_Result["Name"] . "</h3><br>";

if(isset($_SESSION["ID"]))
if($_SESSION["ID"] == $Row_Result["Owner_ID"])  
echo "<a href='UploadPicture.php?AID=". $_GET["AID"]  ."' >Upload a new picture</a>";

}
else {
		header("Location: index.php");
	  }

$Result = mysql_query("SELECT `File_Name`, `Picture_Title`, `Owner_ID`, `Description`, `Upload_Date` FROM `Pictures` 
                       WHERE `Album_ID` = ". $_GET['AID'] ." order by `Upload_Date` Desc",$Connection);




if(mysql_num_rows($Result) > 0)
{
	echo '<table width=100% style="text-align:center;">';

$counter =0;
	
while( $Row_Result = mysql_fetch_assoc($Result) )
{
	if($counter == 0) 
	echo "<tr>";
	
echo '<td><a href="ViewPicture.php?OID='. $Row_Result["Owner_ID"] .'&UDate='.  $Row_Result["Upload_Date"] .'"><img src="UsersImages/'. $Row_Result["Owner_ID"] .'/'.$Row_Result["File_Name"] .'" width="300" alt="'. $Row_Result["Description"] .'" /></a><br><a href="ViewPicture.php?OID='. $Row_Result["Owner_ID"] .'&UDate='.  $Row_Result["Upload_Date"] .'">'.$Row_Result["Picture_Title"].'</a></td>' ;

$counter++;
if($counter ==2) 
{
	$counter = 0;
	echo "</tr>";
	}                                 
}

echo "</table>";
}
else {
	echo "<center><h2>Sorry, There is no designs in this album </h2></center>";
	}
}

?>








<?php
if(isset($_GET["DImage"])) 
{
	if($_GET["DImage"] == "OK") 
	echo "<script language='javascript'>alert('Your picture deleted successfully');</script>";
	else 
   echo "<script language='javascript'>alert('Your picture NOT deleted , try again');</script>";
}
include("Configuration/Footer.php");

?>




