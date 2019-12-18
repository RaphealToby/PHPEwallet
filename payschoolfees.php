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
	

?>
<!DOCTYPE html>
<html>
<head>
	<title>Pay Sch Fees</title>
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
	<h2 align="left">Pay Fees </h2>
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
	

<form action="payschoolfees.php" enctype="multipart/form-data" method="post">
<table width="426" border="0">
  <tr>
    <td width="156" height="34"><div align="left">Payment Purpose:  </div></td>
    <td width="260" class="input-group"><div align="left">
	<span class="input-group">
      <select name="level" id="level">
        <option value="HND1" selected="selected">HND 1</option>
        <option value="HND2">HND 2</option>
      </select>
	  </span>
    </div></td>
  </tr>
  <tr>
    <td height="34"><div align="left">Level: </div></td>
    <td class="input-group"><div align="left">
	<span class="input-group">
      <select name="payment_purpose" id="payment_purpose">
        <option value="School Fees" selected="selected">School Fees</option>
        <option value="Acceptance">Acceptance</option>
      </select>
	  </span>
    </div></td>
  </tr>
  <tr>
    <td height="34"><div align="left">Enter Amount: </div></td>
    <td class="input-group"><label>
      <input name="amount" type="text" id="amount" placeholder="10000" required>
    </label></td>
  </tr>
  <tr>
    <td height="34" class="input-group"><div align="left">Enter Email: </div></td>
    <td><span class="input-group">
      <label>
      
      </label>
	  		<?php
  	// connect to the database
	$db = mysqli_connect('localhost', 'root', '', 'registration');
	$username = $_SESSION['username'];

/*$query = "SELECT * FROM wallet WHERE id=0";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) == 1) {}*/
		
	$Query="SELECT * FROM users WHERE username='$username'";
				if ($result = $db->query($Query)) {
				while ($row = $result->fetch_assoc()) {	
						//echo "The Below Record was found based on the ID you entered";	
								
								//$result = mysql_query("SELECT * FROM wallet WHERE id=0");
								//while($row = mysql_fetch_array($dbresult))
								//	{	
											$wallet_balance = $row['wallet_balance'];
											$email = $row['email'];
									echo "<input name='email' type='email' id='email' value='$email' required>"; 
									echo "<input name='balance' type='text' id='balance' value='$wallet_balance' hidden>";
							/*echo "<br />";
							 $wallet_balance=number_format($wallet_balance,2);
																					
  							echo "<p align ='right'><b><font color='white' size='24'> $wallet_balance</font></b></p>";*/
														
	
									}
						}
	?>
    </span></td>
  </tr>
  <tr>
    <td height="34">&nbsp;</td>
    <td><label>
      <input name="make_payment" type="submit" class="btn" id="make_payment" value="MakePayment">
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

<p>

<?php
	// connect to the database
	$db = mysqli_connect('localhost', 'root', '', 'registration');
	
	if (isset($_POST['make_payment'])) {
	
	$p_level = mysqli_real_escape_string($db, $_POST['level']);
 	 $payment_purpose = mysqli_real_escape_string($db, $_POST['payment_purpose']);
	 $email = mysqli_real_escape_string($db, $_POST['email']);
 	 $amount = mysqli_real_escape_string($db, $_POST['amount']);
	 $balance = mysqli_real_escape_string($db, $_POST['balance']);
	 
		if($amount > $balance){
			echo "<p><font size='16' color ='red'> You do not have enough balance for this payment Fund Wallet</font></p>";
			echo "<script>alert('Insufficient Balance!! Fund Wallet')</script>";
		}
		else{
			 $pay_schfees = "UPDATE users SET wallet_balance=wallet_balance-$amount where email='$email'";
	 //$results = mysqli_query($db, $query);
	// $inform_user="update users set hijack_attempt=hijack_attempt+1,hijack_attempt_all=hijack_attempt_all+1 where user_email='$user_email'";
				if(mysqli_query($db,$pay_schfees))
				{
					$query_upd = "INSERT INTO history (email , amount ,transaction_type) VALUES('$email', '$amount', '$payment_purpose')";
  					mysqli_query($db, $query_upd);
					// =================NOTIFY THE USER ABOUT THE FAILED ATTEMPT=================
					echo "<script>alert('Payment Successful!!')</script>";
					echo "<script>window.open('index.php','_self')</script>";
					//header('location: ../index.php');
					//  $_SESSION['username'] = $username;
					  //$_SESSION['success'] = "Wallet successfully Updated";
					  //header('location: ../index.php');
				exit();
				}
		}

	}
	?>
</p>
</div>

    

		
</body>
</html>