<?
/* version 0.1 */ 
?>
<?php

include("Configuration/Header.php");



?>
	<h3>Login Form</h3>

<center><span style="color:Red;">
<?php


if(isset($_POST['Username'])) 
{

if($_POST['Username'] != "" && $_POST['Password'] != "") {
include("Configuration/DBInfoReader.php");

 $Result = mysql_query("SELECT `ID`, `Name` From `Users` WHERE
                        Email = '". $_POST['Username'] ."' AND `Password` = md5('". $_POST['Password'] . "');" ,$Connection);
                   

                   if($Result && mysql_num_rows($Result) > 0) {

                           $Row_Result = mysql_fetch_assoc($Result) ;    
                    
                        
                     	
                     	$_SESSION['ID'] = $Row_Result["ID"];
   	                $_SESSION['Name'] = $Row_Result['Name'];
                     	header("Location: index.php");
 
                    
                         }         
                           
                  else
echo "You have entered wrong information";

}
else 
echo "Please fill in the fields";

}
?>
</span></center>


<form  id="Login-form" name="Login-form" action="Login.php" method="POST">

	 <fieldset>
<label><span class="text-form">Email:</span></td><td> <input name="Username" type="text" /></label>

<label><span class="text-form">Password:</span></td><td><input name="Password" type="password" /></label>

	
<center>	
  <div class="buttons" style="text-align:center">
                          <a class="button" href="#" onclick="document.getElementById('Login-form').reset()">Clear</a>
                          <a class="button" href="#" onclick="document.getElementById('Login-form').submit()">Login</a>
               </div> 
</center>
<br>		
&nbsp;&nbsp;if you don't have an account you can <a href="Register.php">register here</a>.

</form>

<?php

include("Configuration/Footer.php");

?>

