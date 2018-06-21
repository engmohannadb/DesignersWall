<?
/* version 0.1 */ 
?>
<?php

include("Configuration/Header.php");

if(!isset($_GET["Key"]) || $_GET["Key"] == "" )
 {
 	header("Location: index.php");
 }

?>
 	
 	<h3>Search result for <?php echo $_GET["Key"]; ?> </h3>
 	
 	<?php
include("Configuration/DBInfoReader.php");

$Result = mysql_query("SELECT ID,`File_Name`,`Picture_Title`,`Description`,Owner_ID 
                       FROM `pictures` WHERE `Picture_Title` LIKE '%". $_GET["Key"] ."%' 
                       OR `Description` LIKE '%". $_GET["Key"] ."%'  ;",$Connection);




if(mysql_num_rows($Result) > 0)
{
	echo '<table width=100% style="text-align:center;">';

$counter =0;
	
while( $Row_Result = mysql_fetch_assoc($Result) )
{
	if($counter == 0) 
	echo "<tr>";
	
echo '<td><a href="ViewPicture.php?PID='. $Row_Result["ID"] .'"><img src="UsersImages/'. $Row_Result["Owner_ID"] .'/'.$Row_Result["File_Name"] .'" width="320" height="250" alt="'. $Row_Result["Description"] .'" /></a><br><a href="ViewPicture.php?PID='. $Row_Result["ID"] .'">'.$Row_Result["Picture_Title"].'</a></td>' ;
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
	echo "<center><h2>Sorry, There is no designs match you search.</h2></center>";
	}


?>

<?php

include("Configuration/Footer.php");

?>
