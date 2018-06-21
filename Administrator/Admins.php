<?
/* version 0.1 */ 
?>
<?php
include("Header.php");
?>

    <div class="articleTitle">The Administrators:</div>
        
        
      <div class="articleContent">
<table width="600px" border="1">
<?php


//-----------CHECK THE PERMISSION -------------
						include("../Configuration/DBInfoReader.php");
$Result = mysql_query("SELECT `User_Managment`, `Picture_Managment`, `Categories_Managment`, `Super_Managment` FROM `Administrators`
 WHERE ID =". $_SESSION["AID"],$Connection);
 
$Row_Result = mysql_fetch_assoc($Result);

if(  $Row_Result["Super_Managment"] != 1 && $Row_Result["User_Managment"] != 1 )  
   	header("Location: NotAllowed.php");
//------------------End Checking --------------

$Result = mysql_query("SELECT `ID`, Name ,	Password ,	Register_Date, 	Last_Login ,	User_Managment ,	Picture_Managment ,	Categories_Managment ,	Super_Managment  FROM `Administrators`
",$Connection);


while( $Row_Result = mysql_fetch_assoc($Result) )
{

echo "<tr><td>". $Row_Result["Name"] . "</td><td><a href='UpdateAdmin.php?AID=". $Row_Result["ID"] . "'>Update</a></td><td><a href='DeleteAdmin.php?AID=". $Row_Result["ID"] . "'>Delete</a></td></tr>";

}

?>

</table>

<br>
<a href="AddNewAdmin.php"><u>Add new administrator</u></a>
    </div>

<?php
include("Footer.php");
?>
