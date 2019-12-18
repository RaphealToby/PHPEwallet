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
				$_SESSION['success'] = "You are now logged in";
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
.style3 {
	color: #990000;
	font-weight: bold;
}
-->
    </style>
</head>
<body>
<div class="header">
	<h2 align="left">History</h2>
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
    	<p>Welcome<strong><?php echo $_SESSION['username']; ?></strong></p>
    <?php endif ?>	






<div class="page">
	<p align="center" class="style3"> Transaction History</p>

<form action="history.php" enctype="multipart/form-data" method="post">



<table width="426" border="0">
  <tr>
    <td height="51" align="center" class="input-group"> Enter your email      
      <input name="email" type="text" id="email" class="input-group"></td>
    </tr>
  <tr>
    <td height="51">
      <input name="Check_History" type="submit" id="Check_History" value="Check History" class="btn">      </td>
    </tr>
  <tr>
    <td height="34"><div align="center">
      <?php include('errors.php'); ?>
	  <p>
	    <?php
	if (isset($_POST['Check_History'])) {
	  $email = mysqli_real_escape_string($db, $_POST['email']);
  	// connect to the database
	$db = mysqli_connect('localhost', 'root', '', 'registration');

/*$query = "SELECT * FROM wallet WHERE id=0";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) == 1) {}*/
		
		
	$Query="SELECT * FROM history WHERE email='$email'";
				if ($result = $db->query($Query)) {
				
	echo "<table align='center' padding='1' class='blueTable'><tr><th>Transaction ID</th><th>DATE/TIME</th><th>AMOUNT</th> <th>Transaction Type</th></tr>";
				while ($row = $result->fetch_assoc()) {	
						//echo "The Below Record was found based on the ID you entered";	
								
								//$result = mysql_query("SELECT * FROM wallet WHERE id=0");
								//while($row = mysql_fetch_array($dbresult))
								//	{	
											$transaction_date  = $row['transaction_date'];
											$amount = $row['amount'];
																					
   								     	/*echo "<label>Email</label>";
  	echo "<input name='p_email_display' type='text' value='$transaction_date' disabled='disabled'/>";
 	echo " <label>Amount</label>";*/
						
					echo "<tr><td>" . $row["transaction_id"]. "</td><td>" . $row["transaction_date"]. "</td><td>" . $row["amount"]. "</td><td>" . $row["transaction_type"]. "</td></tr>";
   				}
					echo "</table>";
				}
	}
	?>
	  </p>
    </div></td>
    </tr>
</table>

</form>
<p>

</p>
<p align="center"><span class="style1">Developed by: |Group B </span><span class="style2">&copy;2019</span><span class="style1">|</span></p>
</div>


		
</body>
</html>