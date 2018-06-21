<?
/* version 0.1 */ 
?>
<br>
<center>	<h3>Login Form</h3> </center>


<form  id="Login-form" name="Login-form" action="Login.php" method="POST">

	 <fieldset>
<label><span class="text-form">Email:</span></td><td> <input name="Username" type="text" /></label>

<label><span class="text-form">Password:</span></td><td><input name="Password" type="password" /></label>

	
<center>	

<a href="Login.php" onclick="document.getElementById('Login-form').submit()" rel="insert"><button>Login</button></a>

<a href="#" class="lbAction" rel="deactivate" ><button>Cancel</button></a>
</center>
<br>		
&nbsp;&nbsp;if you don't have an account you can <a href="Register.php">register here</a>.

</form>
