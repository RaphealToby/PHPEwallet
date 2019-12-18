<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Ewallet</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style type="text/css">
<!--
.style1 {
	font-size: 12px;
	color: #990000;
	font-weight: bold;
}
.style2 {color: #5F9EA0}
.style3 {	color: #FF0000;
	font-size: 14px;
	font-weight: bold;
}
-->
  </style>
</head>
<body>
  <div class="header">
  	<h2 align="left">E-Wallet<img src="images/wallet.png" alt="wallet" width="63" height="41"><span class="style2">&gt;&gt;&gt;&gt;&gt;&gt;&gt;</span> Login</h2>
</div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>  	</p>
  	<p>&nbsp;</p>
  	<p align="center" class="style1">Developed by: |Group B <span class="style3">&copy;2019</span>|</p>
  </form>
</body>
</html>