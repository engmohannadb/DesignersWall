<?
/* version 0.1 */ 
?>
<?php
include("Configuration/Header.php");


             if(!isset($_SESSION['ID']) ) 
             {
                     	header("Location: index.php");
             }

include("Configuration/DBInfoReader.php");

$Result = mysql_query("SELECT Name From Albums Where ID = ". $_GET['AID'] ." AND Owner_ID = ". $_SESSION["ID"] ,$Connection);

if($Result && (mysql_num_rows($Result) > 0) )
{
	$Row_Result = mysql_fetch_assoc($Result);
}             
 else 
 	 	header("Location: index.php");
             
?>


<div class="wrapper">
 <div class="grid_12">
 <div class="indent-left">
  <h3 class="p2">Upload Picture to the Album "<?php echo $Row_Result["Name"] ; ?>"</h3>
  <h2 align="center" style=" text-align: center;color:Red;">

<?php

if(isset($_POST['Name']))
if(  $_FILES['filename'] != "" )  
{
	if( $_POST['Name'] != "") 
	{
		  

if ($_FILES["filename"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
else
  {
    
    if($_FILES["filename"]["type"] == "image/jpeg" || $_FILES["filename"]["type"] == "image/gif" ||$_FILES["filename"]["type"] == "image/png" ||$_FILES["filename"]["type"] == "image/bmp" )  
  {
  	
  if( ($_FILES["filename"]["size"] / 1024) <= 3000 )
  {
  
  
  $FName = rand ( 100 , 1000 ) . "_" . $_FILES["filename"]["name"];
  move_uploaded_file($_FILES["filename"]["tmp_name"],"UsersImages/".$_SESSION["ID"]."/". $FName );
  
						include("Configuration/DBInfoWriter.php");

                      $Result = mysql_query("INSERT INTO `DesignersWall`.`Pictures` ( `File_Name`, `Picture_Title`, `Category_ID`, `Owner_ID`, `Album_ID`, `Description`, `Upload_Date`, `View_Counter`, `Design_Program`) 
                      VALUES ( '$FName', '". $_POST["Name"] ."', '". $_POST["Category"] ."', '". $_SESSION["ID"] ."', '". $_GET["AID"] ."', '". $_POST["Description"] ."', CURRENT_TIMESTAMP, '1', '". $_POST["DesignProgram"] ."');",$Connection);
                   

                     	header("Location: ViewAlbum.php?AID=".$_GET["AID"] );
 
                           
                        
	            	
	        }
         else 
       echo "The file shouldn't be larger than 3MB ";
       }
       else 
       echo "This type of file not accepted, use jpg, gif, bmp or png ";	            	
}
                      
         
   }
   else {
   	echo "Enter name for your design";
   	}
}
else {
	echo "Please chose a file";
	}
?>  
  
  </h2>
     <form id="UploadPic-form" name="UploadPic-form" method="post" action="#" enctype="multipart/form-data">                    
          <fieldset>
            <label><span class="text-form">Select file:</span><input name="filename" type="File"></label>
                   <label><span class="text-form">Design Name:</span><input name="Name" type="text"></label>
                   <label><span class="text-form">Description:</span> <input name="Description" type="text"></label>  
                   <label><span class="text-form">Category:</span>
                                                    
                                      <select name="Category" size="0"> 
   <?php
   
   		include("Configuration/DBInfoReader.php");

                      $Result = mysql_query("SELECT ID, Category_Name FROM `Category`",$Connection);
                   

                   if($Result) {

                    while( $Row_Result = mysql_fetch_assoc($Result) )
                        {
                             echo '<option value="'. $Row_Result["ID"] .'">'. $Row_Result["Category_Name"] .'</option>';                    
                         }         
                           
                        }
   
   ?>                
                   
                   </select>
                    </label> 
                   <label><span class="text-form">Design Program:</span>
                   
    <select name="DesignProgram" size="0"> 
   <?php
   
                      $Result = mysql_query("SELECT ID, `Program_Name` FROM `Design_Programs`",$Connection);
                   

                   if($Result) {

                    while( $Row_Result = mysql_fetch_assoc($Result) )
                        {
                             echo '<option value="'. $Row_Result["ID"] .'">'. $Row_Result["Program_Name"] .'</option>';                    
                         }         
                           
                        }
   
   ?>                
                   
                   </select>                   
                   </label>                                    
                                                             
                          <div class="buttons">
                          <a class="button" href="#" onclick="document.getElementById('UploadPic-form').reset()">Clear</a>
                          <a class="button" href="#" onclick="document.getElementById('UploadPic-form').submit()">Upload</a>
                          </div>                             
         </fieldset>						
  </form>
  </div>
 </div>
</div>

<?php
include("Configuration/Footer.php");
?>





