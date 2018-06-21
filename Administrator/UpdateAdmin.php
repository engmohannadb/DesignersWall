<?
/* version 0.1 */ 
?>
<?php
include("Header.php");

if(!isset($_GET["AID"])) 
{
		header("Location: index.php");
}

//-----------CHECK THE PERMISSION -------------
						include("../Configuration/DBInfoReader.php");
$Result = mysql_query("SELECT `User_Managment`, `Picture_Managment`, `Categories_Managment`, `Super_Managment` FROM `Administrators`
 WHERE ID =". $_SESSION["AID"],$Connection);
 
$Row_Result = mysql_fetch_assoc($Result);

if(  $Row_Result["Super_Managment"] != 1 && $Row_Result["User_Managment"] != 1 )  
   	header("Location: NotAllowed.php");
//------------------End Checking --------------

?>

    <div class="articleTitle">Update Administrator:</div>
        
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
                       $Admin = 0;
                       $Users = 0;
                       $Category = 0;
                       $Picture = 0;
                       
                     if(isset($_POST["Admin"]) && $_POST["Admin"] == "on")
                     $Admin = 1;
                     
                     if(isset($_POST["Users"]) && $_POST["Users"] == "on")
                     $Users = 1;
                     
                      if(isset($_POST["Catagory"]) && $_POST["Catagory"] == "on")
                     $Category = 1;
                     
                      if( isset($_POST["Picture"]) && $_POST["Picture"] == "on")
                     $Picture = 1;

                      $Result = mysql_query("UPDATE `Administrators` SET `Name` = '". $_POST["username"] ."' , `Password` =  MD5('". $_POST["Password"] ."') , `User_Managment` = '$Users', `Picture_Managment` =  '$Picture' , 
                      `Categories_Managment` =  '$Category' , `Super_Managment` = '$Admin'  WHERE `ID`=". $_GET["AID"] ,$Connection);
                   

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

$Result = mysql_query("SELECT `Name`,`User_Managment`, `Picture_Managment`, `Categories_Managment`, `Super_Managment`
 FROM `Administrators`
 WHERE ID =". $_GET["AID"],$Connection);
$Row_Result = mysql_fetch_assoc($Result);


?>
<table>
<form method="POST" action="#">
<tr><td>User name:</td><td> <input type="text" name="username" value="<?php echo $Row_Result["Name"]; ?>" /> </td></tr>
<tr><td>Password:</td><td><input type="password" name="Password" /></td></tr>
<tr><td>Re-Password:</td><td><input type="password" name="Re-Password" /></td></tr>
<tr><td>Super Administration:</td> <td>  <input type="checkbox" name="Admin"
 <?php if($Row_Result["Super_Managment"])
 echo "CHECKED"; ?>
 /> </td></tr>
<tr><td>Users Managment</td> <td>  <input type="checkbox" name="Users" 
 <?php if($Row_Result["User_Managment"])
 echo "CHECKED"; ?>
/> </td></tr>
<tr><td>Category Managment</td> <td>  <input type="checkbox" name="Catagory" 
 <?php if($Row_Result["Categories_Managment"])
 echo "CHECKED"; ?>
 /> </td></tr>
<tr><td>Picture Managment</td> <td>  <input type="checkbox" name="Picture" 
 <?php if($Row_Result["Picture_Managment"])
 echo "CHECKED"; ?>
 /> </td></tr>
<tr><td> <input type="reset" value="Clear" /> </td> <td> <input type="submit" value="Update" /> </td></tr>
</form>
</table>
<?php

?>
    </div>

<?php
include("Footer.php");
?>
