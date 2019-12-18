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
  
  // For continuing payment
   
  $username = $_SESSION['username'];
  $amount    = "";
	$errors = array(); 
	
	// connect to the database
	$db = mysqli_connect('localhost', 'root', '', 'registration');
	
if (isset($_POST['pay'])) {
	  $email = mysqli_real_escape_string($db, $_POST['email']);
	  $amount = mysqli_real_escape_string($db, $_POST['amount']);
	
		$query = "SELECT * FROM users WHERE email='$email'";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) == 1) {
		
		
		$query_new = "UPDATE  wallet SET email='$email', last_payment_amt='$amount'";
				mysqli_query($db, $query_new);			
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "Payment Sheduled";
				header('location: payment/index.php');
		}else {
			array_push($errors, "Email not found in our database");
		}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>E-wallet</title>
	<link rel="stylesheet" type="text/css" href="style2.css">
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
	<h2 align="left">Fund Wallet </h2>
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
	

<form action="fundwallet.php" enctype="multipart/form-data" method="post">
<table width="426" border="0">
  <tr>
    <td width="125">&nbsp;</td>
    <td width="285">&nbsp;</td>
  </tr>
  <tr>
    <td height="34">Enter Amount: </td>
    <td class="input-group"><label>
      <input name="amount" type="text" id="amount" placeholder="10000" required>
    </label></td>
  </tr>
  <tr>
    <td height="34" class="input-group">Enter Email: </td>
    <td><span class="input-group">
      <label>
      <input name="email" type="email" id="email" placeholder="email@domain.com" required>
      </label>
    </span></td>
  </tr>
  <tr>
    <td height="34">&nbsp;</td>
    <td><label>
      <input name="pay" type="submit" class="btn" id="pay" value="MakePayment">
    </label></td>
  </tr>
  <tr>
    <td height="34" colspan="2">
		<?php include('errors.php'); ?>
	</td>
    </tr>
</table>
</form>
<p>

</p>
<p align="center"><span class="style1">Developed by: |Group B </span><span class="style2">&copy;2019</span><span class="style1">|</span></p>
</div>


		
</body>
</html>