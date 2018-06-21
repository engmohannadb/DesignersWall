<?
/* version 0.1 */ 
?>
<?php
include("Configuration/Header.php");


?>
<div class="wrapper">
                                            <div class="grid_12">
                                            	<div class="indent-left">
                                                	<h3 class="p2">Contact Form</h3>
         <?php
         
if( isset( $_POST["Name"] ) ) 
{	
 

include('Configuration/SMTPconfig.php');
include('Configuration/SMTPClass.php');

//define the receiver of the email
$to = 'moohhnad@hotmail.com';
//define the subject of the email
$subject = 'Meesage from:'.$_POST["Name"];
//define the message to be sent. Each line should be separated with \n
$message = "Name:". $_POST["Name"] ."!\n ". $_POST["Email"] ." \n ". $_POST["Mobile"] ." \n ". $_POST["Message"] ;
//define the headers we want passed. Note that they are separated with \r\n
//$headers = "From: info	 \r\nReply-To: ". $_POST["Email"] ;
//send the email

$SMTPMail = new SMTPClient ($SmtpServer, $SmtpPort, $SmtpUser, $SmtpPass, $from, $to, $subject, $message);
$SMTPChat = $SMTPMail->SendMail();
echo $SMTPChat." goood ";
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
//echo $mail_sent ? "Thank you for your message was sent, we will contact you." : "Please, try again";
}
                                       	
            	?>
                                                    <form id="contact-form" method="POST" action="#" enctype="multipart/form-data">                    
                                                        <fieldset>
                                                              <label><span class="text-form">Name:</span><input name="Name" type="text"></label>
                                                              <label><span class="text-form">Email:</span><input name="Email" type="text"></label>   
                                                              <label><span class="text-form">Phone:</span><input name="Mobile" type="text"></label>                                    
                                                              <div class="wrapper"><div class="text-form">Message:</div><textarea name="Message"></textarea></div>
                                                              <div class="buttons">
                                                                  <a class="button" href="#" onclick="document.getElementById('contact-form').reset()">Clear</a>
                                                                  <a class="button" href="#" onclick="document.getElementById('contact-form').submit()">Send</a>
                                                              </div>                             
                                                        </fieldset>						
                                                      
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
<?php
include("Configuration/Footer.php");
?>





