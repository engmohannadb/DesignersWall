<?
/* version 0.1 */ 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title>Untitled Page</title>
    <style type="text/css">
        .style1
        {
            width: 100%;
             border-bottom-width: 0px;
             border-spacing: 0px;
              border-collapse: 0px;
        }
        #Submit1
        {
            text-align: center;
        }
        .style2
        {
            text-align: right;
        }
        .style3
        {
            font-size: x-large;
            font-weight: bold;
        }
          .style4
        {
            font-size: large;
            font-weight: bold;
            color: Red;
        }
    </style>
</head>
<body>

<form action="#" method="POST">
    <table border="0" class="style1" style="color: #FFFFFF">
        <tr>
            <td>
                &nbsp;</td>
            <td>
                &nbsp;</td>
            <td>
                &nbsp;</td>
            <td>
                &nbsp;</td>
        </tr>
        <tr>
            <td>
                &nbsp;</td>
            <td class="style3" colspan="2" 
                style="background-color: #002346; text-align: center;">
                Administration</td>
            <td>
                &nbsp;</td>
        </tr>
        <tr>
            <td>
                &nbsp;</td>
            <td class="style4" colspan="2" 
                style="background-color: #002346; text-align: center;">
<?php



if(isset($_POST["Username"]))
if( $_POST["Username"] != "" && $_POST["Password"] != "" ) 
   {
   	
include_once("../Configuration/DBInfoReader.php");
$Result = mysql_query("SELECT `ID` FROM `Administrators` 
                        WHERE  `Name` = '". $_POST["Username"] ."' 
                        AND `Password` = MD5('". $_POST["Password"] ."')",$Connection);
if($Result && (mysql_num_rows($Result)>0)) 
{
	 $Row_Result = mysql_fetch_assoc($Result); 
 
      session_start();
   	$_SESSION['AID'] = $Row_Result["ID"];
   	$_SESSION['Username'] = $_POST["Username"];

include_once("../Configuration/DBInfoWriter.php");
   	
$Result = mysql_query("UPDATE `DesignersWall`.`Administrators` 
                       SET `Last_Login` = NOW( ) 
                       WHERE `Administrators`.`ID` = ". $Row_Result["ID"] ,$Connection);
   	
   	header("Location: Main.php");
   	
	}
	else {
		echo "You entered wrong username or password, Please try again";
		}
}
?>                
                
                </td>
            <td>
                &nbsp;</td>
        </tr>
        <tr>
            <td>
                &nbsp;</td>
            <td class="style2" style="background-color: #002346">
                Username:</td>
            <td style="background-color: #002346">
                <input id="Username" name="Username" type="text" /></td>
            <td>
                &nbsp;</td>
        </tr>
        <tr>
            <td>
                &nbsp;</td>
            <td class="style2" style="background-color: #002346">
                Password:</td>
            <td style="background-color: #002346">
                <input id="Password" name="Password" type="password" /></td>
            <td>
                &nbsp;</td>
        </tr>
        <tr>
            <td>
                &nbsp;</td>
            <td colspan="2" style="background-color: #002346; text-align: center;">
                <input id="Submit1" type="submit" value="Login" /></td>
            <td>
                &nbsp;</td>
        </tr>
        <tr>
            <td>
                &nbsp;</td>
            <td>
                &nbsp;</td>
            <td>
                &nbsp;</td>
            <td>
                &nbsp;</td>
        </tr>
        <tr>
            <td>
                &nbsp;</td>
            <td>
                &nbsp;</td>
            <td>
                &nbsp;</td>
            <td>
                &nbsp;</td>
        </tr>
    </table>
</form>
</body>
</html>
