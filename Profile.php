<?
/* version 0.1 */ 
?>
<?php
include("Configuration/Header.php");

if(!Isset($_GET['PID']) || !is_numeric( $_GET['PID']))
{
	header("Location: NotExist.php");
}

?>


<div class="wrapper">
<div class="grid_12">
 <div class="indent-left">
 <?php
 include("Configuration/DBInfoReader.php");

$Result = mysql_query("SELECT Name,Picture_Filename From Users Where ID = ". $_GET['PID'],$Connection);

if(mysql_num_rows($Result) > 0)
{
$Row_Result = mysql_fetch_assoc($Result); 
echo "<h3>".$Row_Result["Name"] . "'s Profile</h3><br>";
if($Row_Result['Picture_Filename'] == "")
$FileURL = "WebsiteImages/1.bmp";
else  
$FileURL = "UsersImages/".$_GET['PID'] .'/'.  $Row_Result['Picture_Filename'];
}
else {
		header("Location: index.php");
	  }
 ?>
   <form id="Register-form" method="post" enctype="multipart/form-data">                    
          
    <table width="100%" style="width: 100%; " >    
     <tr align="center" valign="middle"><td style="width: 180;">
     <table style="width: 180px;max-width:180px;color:White;">
     <tr align="center" valign="middle"><td style="width: 180;"><img src="<?php echo $FileURL; ?>" width="125" height="125" alt="" /></td></tr>
      <tr style="Height:40px;text-align:center; vertical-align:middle; font-size:large;"><td style="background-image:url('WebsiteImages/button-tail.gif');">
      <?php 
      if(isset($_SESSION["ID"]))  
      echo '<a href="POPMessageME.php?UID='. $_GET['PID'] .'" class="lbOn">Send a message</a>';
      else 
            echo '<a href="POPLogin.php" class="lbOn">Send a message</a>';
            ?>
      </td>      </tr>
      <tr style="Height:40px;text-align:center; vertical-align:middle; font-size:large;"><td style="background-image:url('WebsiteImages/button-tail.gif');"><a href="EmailME.php?UID=<?php echo $_GET['PID']; ?>" class="lbOn">Email me</a></td></tr>
      <tr style="Height:40px;text-align:center; vertical-align:middle; font-size:large;"><td style="background-image:url('WebsiteImages/button-tail.gif');">
 <?php if(isset($_SESSION["ID"]))  
      {
      	include("Configuration/DBInfoReader.php");

$Result = mysql_query("SELECT `Sub_Date` FROM `Subscribes` WHERE `Subsciber_ID` = ". $_SESSION["ID"] ." AND `User_ID` = ". $_GET['PID'],$Connection);

     if($Result && (mysql_num_rows($Result) > 0))
       {
	    echo '<a href="POPSubscribe.php?PID='. $_GET['PID'] .'&Action=Unsubscribe" class="lbOn">Unsubscribe</a>';
	   }
	   else
      	echo '<a href="POPSubscribe.php?PID='. $_GET['PID'] .'&Action=Subscribe" class="lbOn">Subscribe</a>';
      }
      else 
            echo '<a href="POPLogin.php" class="lbOn">Login to Subsribe</a>';
          ?>
     </td> </tr>
     </table>   
     </td>
     <td style="text-align:center;width:800px">&nbsp;
<?php


$Result = mysql_query("SELECT alb.ID,alb.Name,alb.Description,alb.Cretion_date , pic.File_Name FROM `Albums` alb,Pictures pic 
WHERE alb.ID = pic.Album_ID AND alb.Owner_ID = ". $_GET['PID'] ,$Connection);

if(mysql_num_rows($Result) > 0)
{
	echo '<table width=100% style="text-align:center;" border=1>';

$counter =0;
	
while( $Row_Result = mysql_fetch_assoc($Result) )
{
	if($counter == 0) 
	echo "<tr>";
	
echo '<td><a href="ViewAlbum.php?AID='. $Row_Result["ID"] .'"><img src="UsersImages/'. $_GET["PID"] .'/'.$Row_Result["File_Name"] .'" width="300" alt="'. $Row_Result["Description"] .'" /></a><br><a href="ViewAlbum.php?AID='. $Row_Result["ID"] .'">'.$Row_Result["Name"].'</a></td>' ;
$counter++;
if($counter ==2) 
  {
	$counter = 0;
	echo "</tr>";
  }                                 
}

echo "</table>";
}
else {
	echo "<center><h2>There is no albums for this user </h2></center>";
	}
    
?>     
     
        </td>  
     </tr>      
    </table>						
   </form>
  </div>
 </div>
</div>


<?php

if(isset($_GET["Send"])) 
{
	if($_GET["Send"] == "Yes") 
	echo "<script language='javascript'>alert('your message has been send successfully');</script>";
	else 
   echo "<script language='javascript'>alert('your message not send');</script>";
}
if(isset($_GET["Subsribe"])) 
{
	if($_GET["Subsribe"] == "Yes") 
	echo "<script language='javascript'>alert('your are subscribe successfully');</script>";
	else 
   echo "<script language='javascript'>alert('your are unsubscribe successfully');</script>";
}

include("Configuration/Footer.php");
?>





