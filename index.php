<?
/* version 0.1 */ 
?>

<?php
if(isset($_GET["go"]))
if($_GET["go"]== "logout")
{
   session_start();
	session_destroy();	
}
include("Configuration/Header.php");


?>
 	
 	<h3>Welcome to Designers Wall</h3>
 	
 	<?php

	include("Configuration/DBInfoReader.php");

$Result = mysql_query("SELECT `File_Name`,`Picture_Title`,`Description`,Owner_ID, Upload_Date 
                       FROM `Pictures` LIMIT 10;",$Connection);




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
	echo "<center><h2>Sorry, There is no designs in the website </h2></center>";
	}


?>

<?php

include("Configuration/Footer.php");

?>
