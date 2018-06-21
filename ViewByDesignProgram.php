<?
/* version 0.1 */ 
?>
<?php

include("Configuration/Header.php");

if(!Isset($_GET['DID']) || !is_numeric( $_GET['DID']))
{
	header("Location: index.php");
}
else
 {
 	
include("Configuration/DBInfoReader.php");

$Result = mysql_query("SELECT `Program_Name` Program From Design_Programs Where ID = ". $_GET['DID'],$Connection);

if(mysql_num_rows($Result) > 0)
{
$Row_Result = mysql_fetch_assoc($Result); 
echo "<h3>".$Row_Result["Program"] . "</h3><br>";

}
else {
		header("Location: index.php");
	  }

$Result = mysql_query("SELECT `File_Name`,`Picture_Title`,`Description`,Owner_ID ,`Upload_Date`
                       FROM `Pictures` WHERE `Design_Program` = ". $_GET['DID'] ." order by `Upload_Date` Desc",$Connection);

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
	echo "<center><h2>Sorry, There is no designed by this program<br /> Be the first one uploading here.</h2></center>";
	}
}

?>








<?php

include("Configuration/Footer.php");

?>




