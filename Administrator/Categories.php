<?
/* version 0.1 */ 
?>
<?php
include("Header.php");
?>

    <div class="articleTitle">Categories:</div>
        
        
      <div class="articleContent">
<table width="600px" border="1">
<?php

include("../Configuration/DBInfoReader.php");

//-----------CHECK THE PERMISSION -------------Administrators` (`ID`, `Name`, `Password`, `Register_Date`, `Last_Login`, `User_Managment`, `Picture_Managment`, `Categories_Managment`, `Super_Managment`)
$Result = mysql_query("SELECT `User_Managment`, `Picture_Managment`, `Categories_Managment`, `Super_Managment` FROM `Administrators`
 WHERE ID =". $_SESSION["AID"],$Connection);
 
$Row_Result = mysql_fetch_assoc($Result);

if(  $Row_Result["Super_Managment"] != 1 && $Row_Result["Categories_Managment"] != 1 )  
   	header("Location: NotAllowed.php");
//------------------End Checking --------------

$Result = mysql_query("SELECT `ID`, `Category_Name`, `Description` FROM `Category` ",$Connection);


while( $Row_Result = mysql_fetch_assoc($Result) )
{

echo "<tr><td>". $Row_Result["Category_Name"] . "</td><td>". $Row_Result["Description"] . "</td><td><a href='UpdateCategory.php?CID=". $Row_Result["ID"] . "'>Update</a></td><td><a href='DeleteCategory.php?CID=". $Row_Result["ID"] . "'>Delete</a></td></tr>";

}

?>

</table>

<br>
<a href="AddCategory.php"><u>Add new category</u></a>
    </div>

<?php
include("Footer.php");
?>
