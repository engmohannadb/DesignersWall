<?
/* version 0.1 */ 
?>
<?php
include("Configuration/Header.php");

if(!Isset($_GET['OID']) || !is_numeric( $_GET['OID']) || !Isset($_GET['UDate']))
{
	header("Location: NotExist.php");
}

             if(!isset($_SESSION['ID']) ) 
             {
                     	header("Location: index.php");
             }

include("Configuration/DBInfoReader.php");

$Result = mysql_query("SELECT `File_Name`, `Picture_Title`, `Category_ID`, `Album_ID`, `Description`, `Design_Program` 
FROM `Pictures` WHERE  Upload_date = '". $_GET['UDate'] ."'" ." AND Owner_ID = ". $_SESSION["ID"] ,$Connection);

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
  <h3 class="p2">Update Picture </h3>
  <h2 align="center" style=" text-align: center;color:Red;">

<?php

if(isset($_POST['Name']))
{
	if( $_POST['Name'] != "") 
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
    	
           $Result = mysql_query("UPDATE `Pictures` SET  `Picture_Title` = '". $_POST["Name"] ."' , `Category_ID` = '". $_POST["Category"] ."' ,  `Album_ID` = '". $_POST["Album"] ."', 
                      `Description` = '". $_POST["Description"] ."',  `Design_Program` = ". $_POST["DesignProgram"] ." WHERE  Upload_date = '". $_GET['UDate'] ."'" ." AND Owner_ID = ". $_SESSION["ID"] ,$Connection);
                   $PageURL = "Location: ViewPicture.php?OID=".$_SESSION["ID"]."&UDate=".$_GET["UDate"];
          	header("$PageURL");
 
   	}              
   	else
   	 {

 $Result = mysql_query("UPDATE `Pictures` SET  `File_Name` = '". $FName ."', `Picture_Title` = '". $_POST["Name"] ."' , `Category_ID` = '". $_POST["Category"] ."' ,  `Album_ID` = '". $_POST["Album"] ."', 
                      `Description` = '". $_POST["Description"] ."',  `Design_Program` = ". $_POST["DesignProgram"] ." WHERE  Upload_date = '". $_GET['UDate'] ."'" ." AND Owner_ID = ". $_SESSION["ID"],$Connection);
                   
             $PageURL = "Location: ViewPicture.php?OID=".$_SESSION["ID"]."&UDate=".$_GET["UDate"];
          	header("$PageURL");
   		}     
         
   }
   else {
   	echo "Enter name for your design";
   	}
}

?>  
  
  </h2>
     <?php 
  echo    '<img src="UsersImages/'.$_SESSION["ID"].'/'. $Row_Result["File_Name"] .'" alt="" width=500 ><br>';
     ?>
      
     <form id="UploadPic-form" name="UploadPic-form" method="post" action="#" enctype="multipart/form-data">                    
          <fieldset>
            <label><span class="text-form">Select file:</span><input name="filename" type="File"></label>
                   <label><span class="text-form">Design Name:</span><input name="Name" type="text" value="<?php echo $Row_Result["Picture_Title"];  ?>"></label>
                   <label><span class="text-form">Description:</span> <input name="Description" type="text" value="<?php echo $Row_Result["Description"];  ?>"></label>  
                   <label><span class="text-form">Category:</span>
                                                    
                                      <select name="Category" size="0"> 
   <?php
   
   		include("Configuration/DBInfoReader.php");

                      $Result = mysql_query("SELECT ID, Category_Name FROM `Category`",$Connection);
                   

                   if($Result) {

                    while( $Row_Result2 = mysql_fetch_assoc($Result) )
                        {
                             echo '<option value="'. $Row_Result2["ID"] .'"';
                             
                             if( $Row_Result["Category_ID"] ==  $Row_Result2["ID"])
                             echo "SELECTED";
                              
                             echo '>'. $Row_Result2["Category_Name"] .'</option>';                    
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

                    while( $Row_Result2 = mysql_fetch_assoc($Result) )
                        {
                             echo '<option value="'. $Row_Result2["ID"] .'" ';
                               
                               if( $Row_Result["Design_Program"] ==  $Row_Result2["ID"])
                             echo "SELECTED";
                             
                             echo '>'. $Row_Result2["Program_Name"] .'</option>';                    
                         }         
                           
                        }
   
   ?>                
                   
                   </select> 
                   </label>
                   <label>
                   <span class="text-form">Album:</span>
                   <select name="Album" size="0"> 
   <?php
   
                      $Result = mysql_query("SELECT ID, `Name` FROM `Albums` WHERE Owner_ID=". $_SESSION["ID"] ,$Connection);
                   

                   if($Result) {

                    while( $Row_Result2 = mysql_fetch_assoc($Result) )
                        {
                             echo '<option value="'. $Row_Result2["ID"] .'" ';
                               
                               if( $Row_Result["Album_ID"] ==  $Row_Result2["ID"])
                             echo "SELECTED";
                             
                             echo '>'. $Row_Result2["Name"] .'</option>';                    
                         }         
                           
                        }
   
   ?>                
                   
                   </select> 
                                     
                   </label>                                    
                                                             
                          <div class="buttons">
                          <a class="button" href="#" onclick="document.getElementById('UploadPic-form').reset()">Clear</a>
                          <a class="button" href="#" onclick="document.getElementById('UploadPic-form').submit()">Update</a>
                          </div>                             
         </fieldset>						
  </form>
  </div>
 </div>
</div>

<?php
include("Configuration/Footer.php");
?>





