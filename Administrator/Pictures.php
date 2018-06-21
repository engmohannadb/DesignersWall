<?
/* version 0.1 */ 
?>
<?php
include("Header.php");
?>

    <div class="articleTitle">The Pictures:</div>
        
        
      <div class="articleContent">
<table width="600px" border="1">
<?php

//-----------CHECK THE PERMISSION -------------
						include("../Configuration/DBInfoReader.php");
$Result = mysql_query("SELECT `User_Managment`, `Picture_Managment`, `Categories_Managment`, `Super_Managment` FROM `Administrators`
 WHERE ID =". $_SESSION["AID"],$Connection);
 
$Row_Result = mysql_fetch_assoc($Result);

if(  $Row_Result["Super_Managment"] != 1 && $Row_Result["Picture_Managment"] != 1 )  
   	header("Location: NotAllowed.php");
//------------------End Checking --------------

$Result = mysql_query(" SELECT `Picture_Title`,`Owner_ID`,`Upload_Date`  FROM `Pictures` ",$Connection);


while( $Row_Result = mysql_fetch_assoc($Result) )
{

echo "<tr><td>". $Row_Result["Picture_Title"] . "</td><td><a href='DeletePicture.php?OID=". $Row_Result["Owner_ID"] . "&UDate=". $Row_Result["Upload_Date"] ."'>Delete</a></td></tr>";

}

?>

</table>

<br>

    </div>

<?php
include("Footer.php");
?>
