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

if(  $Row_Result["Super_Managment"] != 1 && $Row_Result["User_Managment"] != 1 )  
   	header("Location: NotAllowed.php");
//------------------End Checking --------------

?>

    <div class="articleTitle">Insert new Administrator:</div>
        
      <div class="articleContent">

<?php

if(isset($_POST['username']))
if( $_POST['username'] != "" )  
{
	
		if( $_POST['Password'] != "") 
	    {
	    		if($_POST['Re-Password']  == $_POST['Password'] ) 
	            {
	            	
							include("../Configuration/DBInfoWriter.php");
                       $Admin = $Users = $Category = $Picture = 0;
                       
                     if($_POST["Admin"] == "on")
                     $Admin = 1;
                     
                     if($_POST["Users"] == "on")
                     $Users = 1;
                     
                      if($_POST["Catagory"] == "on")
                     $Category = 1;
                     
                      if($_POST["Picture"] == "on")
                     $Picture = 1;

                      $Result = mysql_query("INSERT INTO `DesignersWall`.`Administrators` (`ID`, Name ,	Password ,	Register_Date, 	Last_Login ,	User_Managment ,	Picture_Managment ,	Categories_Managment ,	Super_Managment )
                       VALUES (NULL, '". $_POST["username"] ."', MD5('". $_POST["Password"] ."'), NOW(), CURRENT_TIMESTAMP, '$Users', '$Picture', '$Category', '$Admin');",$Connection);
                   

                   if($Result) {

                     	header("Location: Admins.php");
   
                        }
	            	
	            	

                      
               }
               else 
               {
               	echo "Please re-type the same password, correctly";
               }
       }
       else 
         {
         	echo "Please enter the password";
       	}
   
}
else {
	echo "Please enter username";
	
	}


?>
<table>
<form method="POST" action="#">
<tr><td>User name:</td><td> <input type="text" name="username" /> </td></tr>
<tr><td>Password:</td><td><input type="password" name="Password" /></td></tr>
<tr><td>Re-Password:</td><td><input type="password" name="Re-Password" /></td></tr>
<tr><td>Super Administration:</td> <td>  <input type="checkbox" name="Admin" /> </td></tr>
<tr><td>Users Managment</td> <td>  <input type="checkbox" name="Users" /> </td></tr>
<tr><td>Category Managment</td> <td>  <input type="checkbox" name="Catagory" /> </td></tr>
<tr><td>Picture Managment</td> <td>  <input type="checkbox" name="Picture" /> </td></tr>
<tr><td> <input type="reset" value="Clear" /> </td> <td> <input type="submit" value="Add Admin" /> </td></tr>
</form>
</table>
<?php

?>
    </div>

<?php
include("Footer.php");
?>
