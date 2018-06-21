<?
/* version 0.1 */ 
?>
<?php

include("Configuration/Header.php");

if(!Isset($_GET['OID']) || !is_numeric( $_GET['OID']) || !Isset($_GET['UDate']) )
{
	header("Location: NotExist.php");
}

	
	

 	
include("Configuration/DBInfoReader.php");

$Result = mysql_query("SELECT  pic.File_Name ,pic.Picture_Title , pic.Category_ID ,cat.Category_Name, pic.Design_Program , prg.Program_Name DesignProgram ,  pic.Owner_ID , Users.Name user_name , pic.Album_ID,  Albums.Name Album_Name ,pic.Description , pic.View_Counter ,pic.Upload_Date 
From Users,Pictures pic,Category cat,Albums, Design_Programs prg Where cat.ID = pic.Category_ID AND pic.Owner_ID = Users.ID AND Albums.ID = pic.Album_ID AND prg.ID = pic.Design_Program  AND pic.Owner_ID = ". $_GET['OID'] ." AND pic.Upload_date = '". $_GET['UDate'] ."'",$Connection);

if(mysql_num_rows($Result) > 0)
{

$Row_Result = mysql_fetch_assoc($Result); 

echo "<h3>".$Row_Result["Picture_Title"] . "</h3> from the album <a href='ViewAlbum.php?AID=". $Row_Result["Album_ID"] ."'>". $Row_Result["Album_Name"] ."</a><br><br>";


if(isset($_SESSION["ID"]))
if($_SESSION["ID"] == $Row_Result["Owner_ID"])  
echo "<a href='UpdatePicture.php?OID=". $_GET["OID"]  ."&UDate=".  $_GET["UDate"]  ."' >Update this picture</a> | " . '<a href="POPDeleteImage.php?UDate='. $_GET['UDate'] .'" class="lbOn"> DELETE this image </a>';



echo '<center><img src="UsersImages/'. $Row_Result["Owner_ID"] .'/'.$Row_Result["File_Name"] .'" style="max-width:900px;"  /><br>';

echo '<hr width="877px"></center><table width="100%"><tr><td width="350px"><span valign="top">Description :<span> <textarea name="Description" rows="5" cols="30" readonly >'. $Row_Result["Description"] .'</textarea><br>';

echo "Album <a href='ViewAlbum.php?AID=". $Row_Result["Album_ID"] ."'>". $Row_Result["Album_Name"] .'</a><br><span style="vertical-align:top;text-align:center;"> Catagory:<a href="ViewCatagory.php?Cat_ID=' .$Row_Result["Category_ID"]  .'">'.$Row_Result["Category_Name"] . "</a> <br> Designed by: <a href='Profile.php?PID=".  $Row_Result["Owner_ID"] ."'>". $Row_Result["user_name"] . "</a>
<br> by using: <a href='ViewByDesignProgram.php?DID=".  $Row_Result["Design_Program"] ."'>". $Row_Result["DesignProgram"] . "</a><br> Uploaded: ". $Row_Result["Upload_Date"] . "<br><br><h2>". $Row_Result["View_Counter"] . " times this design saw</h2>" ;


include("Configuration/DBInfoWriter.php");

$Result = mysql_query("UPDATE `DesignersWall`.`Pictures` SET `View_Counter` = '". ($Row_Result["View_Counter"]+1) . "' WHERE `Pictures`.`Owner_ID` =" . $_GET['OID'] . "  AND Upload_Date ='". $_GET['UDate'] ."'",$Connection); 



include("Configuration/DBInfoReader.php"); // Call it again to prevent writing access
$Result = mysql_query("SELECT count(`Like_Statues`) 'like' FROM `Likes` WHERE  `Like_Statues` = 1 AND  `Picture_Owner_ID` =" . $_GET['OID'] . "  AND Picture_Uploading_Date ='". $_GET['UDate'] ."'",$Connection); 
$Row_Result = mysql_fetch_assoc($Result); 
echo "<br><h2><font style='color:Green;'>". $Row_Result["like"] ." Like it</font> and";

$Result = mysql_query("SELECT count(`Like_Statues`) 'dislike' FROM `Likes` WHERE  `Like_Statues` = 0 AND  `Picture_Owner_ID` =" . $_GET['OID'] . "  AND Picture_Uploading_Date ='". $_GET['UDate'] ."'",$Connection); 
$Row_Result = mysql_fetch_assoc($Result); 
echo "<font style='color:Red;'> ". $Row_Result["dislike"] ." Dislike it</font></h2>";

if( isset($_SESSION["ID"])) 
    {
    	
$Result = mysql_query("SELECT `Like_Statues`  FROM `Likes` WHERE  `Liker_ID` = ". $_SESSION["ID"] ." AND  `Picture_Owner_ID` =" . $_GET['OID'] . "  AND Picture_Uploading_Date ='". $_GET['UDate'] ."'",$Connection); 
if($Result && mysql_num_rows($Result) ) 
{
	$Row_Result = mysql_fetch_assoc($Result); 
	if($Row_Result["Like_Statues"] == "1") 
echo "<center>You Liked it , <a href='Like.php?OID=". $_GET["OID"] ."&UDate=". $_GET["UDate"] ."&LID=0' style='color:Red;'> Dislike</a></center>";
else 
	echo "<center>You Disliked it , <a href='Like.php?OID=". $_GET["OID"] ."&UDate=". $_GET["UDate"] ."&LID=1' style='color:Green;'> Like</a></center>";
}
else 
   {
	echo "<center><a href='Like.php?OID=". $_GET["OID"] ."&UDate=". $_GET["UDate"]  ."&LID=1' style='color:Green;'>Like</a> or <a href='Like.php?OID=". $_GET["OID"] ."&UDate=". $_GET["UDate"]  ."&LID=0' style='color:Red;' >Dislike</a></center>";
	}
    }
 else {
    echo "<center>Please <a href='POPLogin.php' class='lbOn' >login</a> to vote</center>";
     	}


}
echo '</span></td><td >


<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4f0a97a00b24a827"></script>
<!-- AddThis Button END -->

<h2>Comments:</h2>';



$Result = mysql_query("SELECT Comments.Writer_ID,Comments.Subject, Comments.Comment, Users.Name Commenter , Comments.Creation_Date FROM `Comments`,Users WHERE Users.ID = Comments.Writer_ID AND Comments.`Picture_Owner_ID` =" . $_GET['OID'] . "  AND Comments.Picture_Uploading_Date ='". $_GET['UDate'] ."' Order by `Creation_Date`",$Connection);

if( $Result && mysql_num_rows($Result)>0 ) {
	
while( $Row_Result = mysql_fetch_assoc($Result) )
{

echo "<div style='background-color: Gray;'><div> Title:". $Row_Result["Subject"] . " by <a href='Profile.php?PID=". $Row_Result["Writer_ID"] ."'>". $Row_Result["Commenter"] ."</a></div><hr><div>". $Row_Result["Comment"] ."</div></div><br>";

}

}

else {
echo "There is no comment , be the first who comment here!!";	
	}

?>
<br><br>
<center><span id="comment_status" name="comment_status" style="color:Red;" ></span></center>

<?php

if( isset($_POST["Subject"]) ) 
{
	
if($_POST["Subject"] == "" || $_POST["Comment"] == "") 
   {
echo "<script language='javascript'>document.getElementById('comment_status').innerHTML = 'Please enter the subject and the comment';	</script>";
	}
else {
	
include("Configuration/DBInfoWriter.php");
 
$Result = mysql_query("INSERT INTO `DesignersWall`.`Comments` (  `Subject` ,`Comment` ,`Creation_Date` ,`Writer_ID` , `Picture_Owner_ID` ,`Picture_Uploading_Date`)
                                        VALUES ('". $_POST["Subject"] ."', '". $_POST["Comment"] ."' , NOW() , '". $_SESSION["ID"] ."', '". $_GET["OID"] ."', '". $_GET['UDate'] ."' ) " ,$Connection);

if($Result)
{
echo "<script language='javascript'>document.getElementById('comment_status').innerHTML = 'Thank you,Comment added';	</script>";
}
else 
{
echo "<script language='javascript'>document.getElementById('comment_status').innerHTML = 'Not added, try , again';	</script>";	
}
	  }
}


 if( !isset($_SESSION['ID']) ) 
             {
               echo "<center>Please <a href='POPLogin.php' class='lbOn' >login</a> to comment</center>";
             } 
             else {
             	echo '<form  id="Comment-form" name="Comment-form" action="#" method="POST">

	 <fieldset>
     <label><span class="text-form">Subject:</span><input name="Subject" type="text"></label>	
	   <div class="wrapper"><div class="text-form">Message:</div><textarea name="Comment"></textarea></div>
	
<center>	
  <div class="buttons" style="text-align:center">
                          <a class="button" href="#" onclick="document.getElementById('. "'Comment-form'" .').submit()">Comment</a>
               </div> 
</center>
</form>';
             	}
?>

</td></tr></table>


<?php
if(isset($_GET["Like"])) 
{
	if($_GET["Like"] == "1") 
	echo "<script language='javascript'>alert('Thank you for like');</script>";
	else 
   echo "<script language='javascript'>alert('Your vote has been added');</script>";
}
include("Configuration/Footer.php");

?>