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
//------------------End Checking --------------

?>

    <div class="articleTitle">Update Category:</div>
        
      <div class="articleContent">

<?php

if(isset($_POST['Category']))
if( $_POST['Category'] != "" )  
{
	
		
	    		
	            	
							include("../Configuration/DBInfoWriter.php");
                       

      $Result = mysql_query("Update `Category`  SET   `Category_Name` = '".  $_POST["Category"]  ."' , `Description` = '". $_POST["Description"] ."' , `Creator` = '". $_SESSION["AID"] ."'  
      WHERE ID = ". $_GET["CID"],$Connection);
                   

                   if($Result) {

                     	header("Location: Categories.php");
   
                        }
	            	
	            	

                      
               
      
   
}
else {
	echo "Please enter Category Name";
	
	}


$Result = mysql_query("SELECT `ID`,`Category_Name`, `Description`  FROM `Category`
 WHERE ID =". $_GET["CID"],$Connection);
$Row_Result = mysql_fetch_assoc($Result);

?>
<table>
<form method="POST" action="#">
<tr><td>Category name:</td><td> <input type="text" name="Category" value="<?php echo $Row_Result["Category_Name"]; ?>" /> </td></tr>
<tr><td>Description:</td><td>  <textarea name="Description" rows="10" cols="60"><?php echo $Row_Result["Description"]; ?></textarea> </td></tr>
<tr><td> <input type="reset" value="Clear" /> </td> <td> <input type="submit" value="Update" /> </td></tr>
</form>
</table>
<?php

?>
    </div>

<?php
include("Footer.php");
?>
