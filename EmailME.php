<?
/* version 0.1 */ 
?>

<br>
<center>

<?php


if(!Isset($_GET['UID']) || !is_numeric( $_GET['UID']))
{
	header("Location: NotExist.php");
}

include("Configuration/DBInfoReader.php");

$Result = mysql_query("SELECT Name,Email From Users Where ID = ". $_GET['UID'],$Connection);

if(mysql_num_rows($Result) > 0)
{
$Row_Result = mysql_fetch_assoc($Result); 
echo "<h3>".$Row_Result["Name"] . "'s Email</h3><br>". "<h2>".$Row_Result["Email"] . "</h2><br>";

}
else {
		header("Location: index.php");
	  }

?>
	


<a href="#" class="lbAction" rel="deactivate" ><button>Close</button></a>
</center>
<br>
</form>
