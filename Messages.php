<?
/* version 0.1 */ 
?>
<?php

include("Configuration/Header.php");


if(!isset($_SESSION["ID"])) 
header("Location: Login.php");
?>
	<h3>Messages </h3>
<br>
<?php

include("Configuration/DBInfoReader.php");

$Result = mysql_query("select  msg.`Reciver`, msg.`Sender` , us1.Name Sender_Name,us2.Name Receiver_Name ,msg.`Message` ,msg.`Read_Y_N`,msg.`Sending_Time`
From  `Messages` msg, Users us1, Users us2  
WHERE msg.`Sender` = us1.ID
AND msg.`Reciver` = us2.ID
AND (msg.`Reciver` = ". $_SESSION["ID"] ." OR msg.`Sender` = ". $_SESSION["ID"] ." ) ORDER BY msg.`Sending_Time` DESC" ,$Connection);

if($Result && (mysql_num_rows($Result) > 0) )
{
 		while( $Row_Result = mysql_fetch_assoc($Result) )
{
	$Readed = "White";
	if( $Row_Result["Read_Y_N"] == 0)
	 	$Readed = "Gray";
	 	
echo "<div style='background-color: $Readed;'><div> Sent from <a href='Profile.php?PID=". $Row_Result["Sender"] ."'>". $Row_Result["Sender_Name"] . "</a> to <a href='Profile.php?PID=". $Row_Result["Reciver"] ."'>". $Row_Result["Receiver_Name"] . "</a> 
 on ". $Row_Result["Sending_Time"] ;
 
	if( $Row_Result["Read_Y_N"] == 1)
	 	echo  " <font style='color:Red;'>(NEW)</font> ";

$ReplayTO = $Row_Result["Sender"]; 	 	
if($Row_Result["Sender"] == $_SESSION["ID"])
 	$ReplayTO = $Row_Result["Reciver"];
 	
 echo '<a href="POPMessageME.php?UID='. $ReplayTO .'" class="lbOn">Replay</a>';	 	
 echo "</div><div><h4>". $Row_Result["Message"] ."</h4></div></div><hr><br>";
}

}
else {
		echo "There is no messages";
	  }

?>

<?php


include("Configuration/DBInfoWriter.php");

$Result = mysql_query("UPDATE Messages SET `Read_Y_N` = 0
WHERE `Reciver` = " . $_SESSION["ID"]  ,$Connection);


include("Configuration/Footer.php");

?>

