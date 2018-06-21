<?
/* version 0.1 */ 
?>
<?php

include("Configuration/Header.php");

if(!isset($_SESSION["ID"])) 
  {
  	header("Location: Login.php");
	}
 	
include("Configuration/DBInfoReader.php");

echo "<h3>My subscription list</h3><br>";

$Result = mysql_query("SELECT sub.`Sub_Date`,sub.`User_ID`,usr.Name FROM `Subscribes` sub,Users usr 
WHERE usr.ID = sub.User_ID AND sub.`Subsciber_ID` = ". $_SESSION['ID'],$Connection);


if(mysql_num_rows($Result) > 0)
{
	echo '<table width=100% style="text-align:center;">';

$counter =0;
	
while( $Row_Result = mysql_fetch_assoc($Result) )
{
	if($counter == 0) 
	echo "<tr>";
	
echo '<td><h2><a href="Profile.php?PID='. $Row_Result["User_ID"] .'">'. $Row_Result["Name"] .'</a></h2>Subscribe from: '. $Row_Result["Sub_Date"] .'</td>' ;
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
	echo "<center><h2>Sorry, you are not subscribe to any designers <br /> Learn how to use the website <a href='Help.php'>from here</a>.</h2></center>";
	}


?>







<br>
<?php

include("Configuration/Footer.php");

?>




