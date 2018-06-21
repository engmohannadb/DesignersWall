<?
/* version 0.1 */ 
?>
<?php
include("Configuration/Header.php");

if(!Isset($_SESSION['ID']) )
{
	header("Location: index.php");
}

?>


<div class="wrapper">
<div class="grid_12">
 <div class="indent-left">
 <?php
 include("Configuration/DBInfoReader.php");

$Result = mysql_query("SELECT Name,Picture_Filename From Users Where ID = ". $_SESSION['ID'],$Connection);

if(mysql_num_rows($Result) > 0)
{
$Row_Result = mysql_fetch_assoc($Result); 
echo "<h3>My Profile</h3><br>";
if($Row_Result['Picture_Filename'] == "")
$FileURL = "WebsiteImages/1.bmp";
else  
$FileURL = "UsersImages/".$_SESSION['ID'] .'//'.  $Row_Result['Picture_Filename'];

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
      <tr style="Height:40px;text-align:center; vertical-align:middle; font-size:large;"><td style="background-image:url('WebsiteImages/button-tail.gif');"><a href="Messages.php" >Messages</a></td>      </tr>
      <tr style="Height:40px;text-align:center; vertical-align:middle; font-size:large;"><td style="background-image:url('WebsiteImages/button-tail.gif');"><a href="EditmyInfo.php">Edit My info</a></td></tr>
      <tr style="Height:40px;text-align:center; vertical-align:middle; font-size:large;"><td style="background-image:url('WebsiteImages/button-tail.gif');"><a href="Subscription.php">Subscription List</a></td></tr>
      <tr style="Height:40px;text-align:center; vertical-align:middle; font-size:large;"><td style="background-image:url('WebsiteImages/button-tail.gif');"><a href="POPCreateAlbum.php" class="lbOn">Create an album</a></td></tr>
     </table>   
     </td>
     <td style="text-align:center;width:800px">
     <center> The albums without picture will not appear to your profile visitors. </center>

<?php


$Result = mysql_query("SELECT ID, Name, Description, Cretion_date FROM `Albums` WHERE Owner_ID = ". $_SESSION['ID'] ,$Connection);

if(mysql_num_rows($Result) > 0)
{
	echo '<table width=100% style="text-align:center;" border=1>';

$counter =0;
	
while( $Row_Result = mysql_fetch_assoc($Result) )
{
	if($counter == 0) 
	echo "<tr>";
	
	$Result2 = mysql_query("SELECT File_Name FROM `Pictures` WHERE Album_ID = ".$Row_Result["ID"] ,$Connection);
if($Result2 && (mysql_num_rows($Result2) > 0)) 	
{
	$Row_Result2 = mysql_fetch_assoc($Result2);
echo '<td><a href="ViewAlbum.php?AID='. $Row_Result["ID"] .'"><img src="UsersImages/'. $_SESSION['ID'] .'/'.$Row_Result2["File_Name"] .'" width="300" alt="'. $Row_Result["Description"] .'" /></a><br><a href="ViewAlbum.php?AID='. $Row_Result["ID"] .'">'.$Row_Result["Name"].'</a></td>' ;
}
else
echo '<td><a href="ViewAlbum.php?AID='. $Row_Result["ID"] .'"><img src="WebsiteImages/noImage.jpg" width="300" height="250" alt="'. $Row_Result["Description"] .'" /></a><br><a href="ViewAlbum.php?AID='. $Row_Result["ID"] .'">'.$Row_Result["Name"].'</a></td>' ;
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
	echo "<center><h2>There is no albums for you create one from the menu </h2></center>";
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
if(isset($_GET["CreateAlbum"])) 
{
	if($_GET["CreateAlbum"] == "Yes") 
	echo "<script language='javascript'>alert('your album created successfully');</script>";
	else 
   echo "<script language='javascript'>alert('your album not created , try again');</script>";
}

include("Configuration/Footer.php");
?>





