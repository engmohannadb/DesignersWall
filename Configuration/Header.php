<?
/* version 0.1 */ 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Designers Wall</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/grid.css" type="text/css" media="screen"> 
    <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
    <script src="js/jquery.galleriffic.js" type="text/javascript"></script>
    <script src="js/jquery.opacityrollover.js" type="text/javascript"></script>      
	<!--[if lt IE 7]>
        <div style=' clear: both; text-align:center; position: relative;'>
            <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0"  alt="" /></a>
        </div>
	<![endif]-->
    <!--[if lt IE 9]>
   		<script type="text/javascript" src="js/html5.js"></script>
        <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
	<![endif]-->

<!--POP CSS -->
<link rel="stylesheet" href="css/POPcss/lightbox.css" media="screen,projection" type="text/css" />

<!-- POP JavaScript -->
<script type="text/javascript" src="js/POPscripts/prototype.js"></script>
<script type="text/javascript" src="js/POPscripts/lightbox.js"></script>

</head>
<body id="page1">
	<!--==============================header=================================-->
    <header>
    	<div class="row-1">
        	<div class="main">
            	<div class="container_12">
                	<div class="grid_12">
                    	<nav>
                            <ul class="menu">
                                <li><a href="index.php">Home</a></li>
                               <?php
session_start();
if(isset($_SESSION['ID'] ))
echo '<li><a href="MyProfile.php">My Profile</a></li>';
else
echo '<li><a href="Register.php">Register</a></li>';
   	

?>
                                <li><a href="Catagories.php">Catagories</a></li>
                                <li><a href="Help.php">Help</a></li>
                                <li><a href="Contactus.php">Contact us</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="row-2">
        	<div class="main">
            	<div class="container_12">
                	<div class="grid_9">
                    	<h1>
                            <a class="logo" href="index.php"><img src="WebsiteImages\logo_b.png"    style=" width: 110px;"></a>
                            
                        </h1>
                    </div>
                    <div class="grid_3">
                    	<form id="search-form" method="GET" action="Search.php" enctype="multipart/form-data">
                            <fieldset>	

                                <div class="search-field">
                                    <input name="Key" type="text" />
                                    <a class="search-button" href="#" onClick="document.getElementById('search-form').submit()"><span>search</span></a>	
                                </div>						
                            </fieldset>
                        </form>
<?php
if(isset($_SESSION['ID'] ))
echo 'Welcome '.$_SESSION['Name'] . ' | <a href="index.php?go=logout" align="right;">Logout</a>' ;
else
echo '<a href="POPLogin.php" class="lbOn"  align="right;">Login</a> or <a href="Register.php" >Register here</a> ';

?>
                     </div>
                     <div class="clear"></div>
                </div>
            </div>
        </div>    	
    </header><div class="ic">More Website Templates  @ TemplateMonster.com - August22nd 2011!</div>
    
<!-- content -->
    <section id="content">
        <div class="bg-top">
        	<div class="bg-top-2">
                <div class="bg">
                    <div class="bg-top-shadow">
                        <div class="main">
                            <div class="gallery p3">
                            	

