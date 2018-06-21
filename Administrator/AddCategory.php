<?
/* version 0.1 */ 
?>
<?php
include("Header.php");

//-----------CHECK THE PERMISSION -------------
						include("../Configuration/DBInfoReader.php");
$Result = mysql_query("SELECT `User_Managment`, `Picture_Managment`, `Categories_Managment`, `Super_Managment` FROM `Administrators`
 WHERE ID =". $_SESSION["AID"],$Connection);
 
$Row_Result = mysql_fetch_assoc($Result);

if(  $Row_Result["Super_Managment"] != 1 || $Row_Result["Categories_Managment"] != 1 )  
   	header("Location: NotAllowed.php");

?>

    <div class="articleTitle">Add new Category:</div>
        
      <div class="articleContent">

<?php

if(isset($_POST['Category']))
if( $_POST['Category'] != "" )  
{
	
		
	    		
	            	
							include("../Configuration/DBInfoWriter.php");
                       

      $Result = mysql_query("INSERT INTO `DesignersWall`.`Category` (`ID`, `Category_Name`, `Description`, `Creator`) VALUES (NULL, '". $_POST["Category"] ."', '". $_POST["Description"] ."', '". $_SESSION["AID"] ."');",$Connection);
                   

                   if($Result) {

                     	header("Location: Categories.php");
   
                        }
	            	
	            	

                      
               
      
   
}
else {
	echo "Please enter Category Name";
	
	}


?>
<table>
<form method="POST" action="#">
<tr><td>Category name:</td><td> <input type="text" name="Category" /> </td></tr>
<tr><td>Description:</td><td>  <textarea name="Description" rows="10" cols="60"></textarea> </td></tr>
<tr><td> <input type="reset" value="Clear" /> </td> <td> <input type="submit" value="Add Category" /> </td></tr>
</form>
</table>
<?php

?>
    </div>

<?php
include("Footer.php");
?>
