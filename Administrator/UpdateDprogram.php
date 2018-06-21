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

    <div class="articleTitle">Update Design Program:</div>
        
      <div class="articleContent">

<?php

if(isset($_POST['Dprogram']))
if( $_POST['Dprogram'] != "" )  
{
	
		
	    		
	            	
							include("../Configuration/DBInfoWriter.php");
                       

      $Result = mysql_query("Update `Design_Programs`  SET   `Program_Name` = '".  $_POST["Dprogram"]  ."' , `Description` = '". $_POST["Description"] ."'  
      WHERE ID = ". $_GET["DID"],$Connection);
                   

                   if($Result) {

                     	header("Location: Dprogram.php");
   
                        }
	            	
	            	

                      
               
      
   
}
else {
	echo "Please enter Design Program name";
	
	}


$Result = mysql_query("SELECT `ID`,`Program_Name`, `Description`  FROM `Design_Programs`
 WHERE ID =". $_GET["DID"],$Connection);
$Row_Result = mysql_fetch_assoc($Result);

?>
<table>
<form method="POST" action="#">
<tr><td>Design program name:</td><td> <input type="text" name="Dprogram" value="<?php echo $Row_Result["Program_Name"]; ?>" /> </td></tr>
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
