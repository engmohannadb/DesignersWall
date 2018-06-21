<?
/* version 0.1 */ 
?>
<br><br><br>
<center>	<h4>Are you sure you would like to <?php echo $_GET["Action"];?></h4> 

<form id="contact-form" method="POST" action="#" enctype="multipart/form-data">                    
                                                        <fieldset>
                                                              <div class="buttons">
                    
                                                             <center>     <a class="button" href="<?php echo 'Subscribe.php?UID='. $_GET['PID']; ?>" ><?php echo $_GET["Action"];?></a></center>
                                                              </div>                             
                                                        </fieldset>						
                                                      
                                                    </form>
<a href="#" class="lbAction" rel="deactivate" ><button>Cancel</button></a>


</center>
