<?
/* version 0.1 */ 
?>
<?php
include("Configuration/Header.php");
?>


<h3>Categories</h3>
<table width="100%" style=" text-align: center;" cellspacing="20" cellpadding="50">

<?php

include("Configuration/DBInfoReader.php");

$Result = mysql_query("Select ID, Category_Name, Description from Category",$Connection);

$counter = 0;
while( $Row_Result = mysql_fetch_assoc($Result) )
{
if($counter == 0 )
echo "<tr>";

$counter++;

echo "<td><h2><a href='ViewCatagory.php?Cat_ID=". $Row_Result["ID"] . "'>". $Row_Result["Category_Name"] . "</a></h2>   " . $Row_Result["Description"] . "</td>";

if($counter >= 2 )
{
echo "</tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
$counter = 0;
}

}

?>

</table>








<?php
include("Configuration/Footer.php");
?>




