<?
/* version 0.1 */ 
?>
<center>

<?php


if(!Isset($_GET['UID']) || !is_numeric( $_GET['UID']))
{
	header("Location: NotExist.php");
}

include("Configuration/DBInfoReader.php");

$Result = mysql_query("SELECT Name From Users Where ID = ". $_GET['UID'],$Connection);

if(mysql_num_rows($Result) > 0)
{
$Row_Result = mysql_fetch_assoc($Result); 
echo "<h3> Send message to ".$Row_Result["Name"] . "</h3>";

}
else {
		header("Location: index.php");
	  }

?>
<div style=" text-align:right;"><a href="#" class="lbAction" rel="deactivate" ><button>Close</button></a></div>
	
 <form id="PMessage-form" method="POST" action="MessageME.php?UID=<?php echo $_GET['UID']; ?>" >                    
                                                        <fieldset>
                                                              <div class="wrapper"><div class="text-form">Message:</div><textarea name="Message"></textarea></div>
                                                              
                                                                  <a class="lbAction" href="#" onclick="document.getElementById('PMessage-form').submit()" ><button>Send</button></a>
                                                            
                                                        </fieldset>						
                                        
      </form>

  


</center>
<br>
