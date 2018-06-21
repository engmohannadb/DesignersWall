<?
/* version 0.1 */ 
?>
<?php
include("Configuration/Header.php");


             if(isset($_SESSION['ID']) ) 
             {
                     	header("Location: index.php");
                 }
?>


<div class="wrapper">
 <div class="grid_12">
 <div class="indent-left">
  <h3 class="p2">Register Form</h3>
  <h2 align="center" style=" text-align: center;color:Red;">

<?php

if(isset($_POST['Name']))
if( $_POST['Name'] != "" )  
{
	if( $_POST['Email'] != "") 
	{
		if( $_POST['Password'] != "") 
	    {
	    		if($_POST['Re-Password']  == $_POST['Password'] ) 
	            {
	            	
							include("Configuration/DBInfoWriter.php");

                      $Result = mysql_query("INSERT INTO `DesignersWall`.`Users` (`ID`, `Name`, Picture_Filename , `Email`, `Password`, `Register_Date`) 
                        VALUES (NULL, '". $_POST['Name'] ."', NULL , '". $_POST['Email'] ."', md5('". $_POST['Password'] ."'), CURRENT_TIMESTAMP);",$Connection);
                   

                   if($Result) {

                      $Result = mysql_query("Select ID from Users where Email =  '". $_POST['Email'] ."';",$Connection);
                                
                    while( $Row_Result = mysql_fetch_assoc($Result) )
                        {
                        
                    mkdir("UsersImages/".$Row_Result["ID"] ,0755);
                            
                     //	session_start();
                     	$_SESSION['ID'] = $Row_Result["ID"];
   	                  $_SESSION['Name'] = $_POST['Name'];
                     	header("Location: index.php");
 
                    
                         }         
                           
                        }
                        else {
                        
                       $Result = mysql_query("Select ID from Users where Email =  '". $_POST['Email'] ."';",$Connection);
                        if($Result && (mysql_num_rows($Result) > 0 ) ) 
                        echo "This Email have been used be another user";
                        else 
                        echo "Somthing wrong , Check your information and try again";
	            	
	            	

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
   	echo "Please enter you Email.";
   	}
}
else {
	echo "Please enter your name";
	}
?>  
  
  </h2>
     <form id="Register-form" name="Register-form" method="post" action="#" enctype="multipart/form-data">                    
          <fieldset>
                   <label><span class="text-form">Name:</span><input name="Name" type="text"></label>
                   <label><span class="text-form">Email:</span><input name="Email" type="text"></label>  
                   <label><span class="text-form">Password:</span><input name="Password" type="password"></label> 
                   <label><span class="text-form">Re-password:</span><input name="Re-Password" type="password"></label>                                    
                                                             
                          <div class="buttons">
                          <a class="button" href="#" onclick="document.getElementById('Register-form').reset()">Clear</a>
                          <a class="button" href="#" onclick="document.getElementById('Register-form').submit()">Register</a>
                          </div>                             
         </fieldset>						
  </form>
  </div>
 </div>
</div>

<?php
include("Configuration/Footer.php");
?>





