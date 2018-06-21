<?
/* version 0.1 */ 
?>
<?php
include("Configuration/Header.php");


             if(!isset($_SESSION['ID']) ) 
             {
                     	header("Location: index.php");
             }
             
      
?>


<div class="wrapper">
 <div class="grid_12">
 <div class="indent-left">
  <h3 class="p2">Update my information</h3>
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
						   $FName = "No";
								  
						if($_FILES['filename'] != "" && $_FILES['filename']["type"] != NULL)
						  {
						    
						    if($_FILES["filename"]["type"] == "image/jpeg" || $_FILES["filename"]["type"] == "image/gif" ||$_FILES["filename"]["type"] == "image/png" ||$_FILES["filename"]["type"] == "image/bmp" )  
						  {
						  	
						  if( ($_FILES["filename"]["size"] / 1024) <= 3000 )
						  {
						
						  $FName = rand ( 100 , 1000 ) . "_" . $_FILES["filename"]["name"];
						  move_uploaded_file($_FILES["filename"]["tmp_name"],"UsersImages/".$_SESSION["ID"]."/". $FName );
						  
												
							 }
						    else 
						       echo "The file shouldn't be larger than 3MB ";
						       }
						       else 
						       echo "This type of file not accepted, use jpg, gif, bmp or png ";	            	
						}


							include("Configuration/DBInfoWriter.php");

	            	if($FName == "No")
                    {
	            	
                      $Result = mysql_query("UPDATE `Users` SET  `Name` = '". $_POST['Name'] ."' , `Email` = '". $_POST['Email'] ."'
                      , `Password` =  md5('". $_POST['Password'] ."')    WHERE `ID` = ". $_SESSION["ID"] ." ;",$Connection);
                    }
                    else {
                    	
                      $Result = mysql_query("UPDATE `Users` SET  `Name` = '". $_POST['Name'] ."' , `Email` = '". $_POST['Email'] ."'
                      , `Password` =  md5('". $_POST['Password'] ."'), Picture_Filename = '". $FName ."'    WHERE `ID` = ". $_SESSION["ID"] ." ;",$Connection);
                    	}  
                      header("Location: MyProfile.php"); 
                   
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
	
	

    include("Configuration/DBInfoReader.php");

$Result = mysql_query("SELECT Name,Picture_Filename,Password,Email From Users Where ID = ". $_SESSION['ID'],$Connection);

if(mysql_num_rows($Result) > 0)
{
$Row_Result = mysql_fetch_assoc($Result);
$_SESSION["Name"] = $Row_Result["Name"]; 
}
else {
		header("Location: index.php");
	  }	
	
if($Row_Result['Picture_Filename'] == "")
$FileURL = "WebsiteImages/1.bmp";
else  
$FileURL = "UsersImages/".$_SESSION['ID'] .'/'.  $Row_Result['Picture_Filename'];
?>  
  
  </h2>
  Your current picture: <img src="<?php echo $FileURL; ?>" width="125" height="125" alt="" />
     <form id="Register-form" name="Register-form" method="POST" action="#" enctype="multipart/form-data">                    
          <fieldset>
                   <label><span class="text-form">Name:</span><input name="Name" type="text" value="<?php echo $Row_Result["Name"]; ?>"></label>
                   <label><span class="text-form">Email:</span><input name="Email" type="text" value="<?php echo $Row_Result["Email"]; ?>"></label>
                    <label><span class="text-form">Select a Picture:</span><input name="filename" type="File"></label>  
                   <label><span class="text-form">Password:</span><input name="Password" type="password" ></label> 
                   <label><span class="text-form">Re-password:</span><input name="Re-Password" type="password"></label>                                    
                                                             
                          <div class="buttons">
                          <a class="button" href="#" onclick="document.getElementById('Register-form').reset()">Clear</a>
                          <a class="button" href="#" onclick="document.getElementById('Register-form').submit()">Update</a>
                          </div>                             
         </fieldset>						
  </form>
  </div>
 </div>
</div>

<?php
include("Configuration/Footer.php");
?>

