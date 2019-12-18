<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>E-Wallet</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    <style type="text/css">
<!--
.style1 {	font-size: 12px;
	color: #990000;
	font-weight: bold;
}
.style2 {
	color: #FF0000;
	font-size: 14px;
	font-weight: bold;
}
-->
    </style>
</head>
<body>

<div class="header">
	<h2 align="left">Home Page</h2>
     <table width="338" border="0">
      <tr>
        <td width="57"><a href="index.php" style="color: red;"><img src="images/home.png" alt="paySchf" width="41" height="41" border="0"></a></td>
        <td width="271"><div align="right">
		<a href="payschoolfees.php" style="color: red;"><img src="images/pay-date.png" alt="paySchf" width="60" height="60" border="0"></a> 
		<a href="fundwallet.php" style="color: red;"><img src="images/fundWallet.png" alt="fund" width="60" height="60" border="0"></a>
		<a href="history.php" style="color: red;"><img src="images/wallet2.png" alt="chkwallet" width="60" height="60" border="0"></a>
		<a href="index.php?logout='1'" style="color: red;"><img src="images/shutdown.png" alt="logoff"width="55" height="55"></a></div></td>
      </tr>
    </table>
  <p align="right">&nbsp;</p>

</div>

<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome<strong> <?php echo $_SESSION['username']; ?></strong></p>
    <?php endif ?>	

<div class="page">
	<h2 align="left">Wallet</h2>
    <p class="page">Test</p>

</div>



<p>&nbsp;</p>
<p align="center"><span class="style1">Developed by: |Group B </span><span class="style2">&copy;2019</span><span class="style1">|</span></p>
</div>

		
</body>
</html>