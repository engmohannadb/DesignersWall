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

    <div class="articleTitle">Add new Design Program:</div>
        
      <div class="articleContent">

<?php

if(isset($_POST['Dprogram']))
if( $_POST['Dprogram'] != "" )  
{
	
		
	    		
	            	
							include("../Configuration/DBInfoWriter.php");
                       

      $Result = mysql_query("INSERT INTO `DesignersWall`.`Design_Programs` (`ID`, `Program_Name`, `Description`) VALUES (NULL, '". $_POST["Dprogram"] ."', '". $_POST["Description"] ."');",$Connection);
                   

                   if($Result) {

                     	header("Location: Dprogram.php");
   
                        }
	            	
	            	

                      
               
      
   
}
else {
	echo "Please enter design program Name";
	
	}


?>
<table>
<form method="POST" action="#">
<tr><td>Design program name:</td><td> <input type="text" name="Dprogram" /> </td></tr>
<tr><td>Description:</td><td>  <textarea name="Description" rows="10" cols="60"></textarea> </td></tr>
<tr><td> <input type="reset" value="Clear" /> </td> <td> <input type="submit" value="Add Program" /> </td></tr>
</form>
</table>
<?php

?>
    </div>

<?php
include("Footer.php");
?>
