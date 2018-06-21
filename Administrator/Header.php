<?
/* version 0.1 */ 
?>
 <!--
Design by Bryant Smith
http://www.bryantsmith.com
http://www.aszx.net
Released absolutely free to use anywhere, all I ask is that you kindly leave the link back at the bottom.

Name       : A Subtle Beige
Description: Two column (w/ one micro column for links)
Version    : 1.0
Released   : 20081008
-->
<?php
session_start();
if(!isset($_SESSION["AID"]))
header("Location: DW-Admin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Designers Wall</title>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="asubtlebeige.css" />
<style type="text/css">
<!--
body {
	background-color: #000000;
}
-->
</style></head>
<body>
<div id="page"> 
    <div id="header">
    	<div class="title">Designers Wall Administration Site</div>
        <div class="subText" ><h2 style="color:white;">
<?php

echo "Welcome " . $_SESSION['Username'] . " | ";
?>
<a href="../index.php?go=logout" style="color:white;">Logout</a></h2></div>    
    </div>
    <div id="bar">
        
        <div class="menuLink"><a href="Categories.php">Categories</a></div>
        <div class="menuLink"><a href="Dprogram.php">Design Programs</a></div>
        <div class="menuLink"><a href="Admins.php">Administrators</a></div>
        <div class="menuLink"><a href="Users.php">Users</a></div>
        <div class="menuLink"><a href="Albums.php">Albums</a></div>
        <div class="menuLink"><a href="Pictures.php">Pictures</a></div>

    </div>
    <div id="pageContent">
    
