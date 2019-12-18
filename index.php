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
    	<p>Welcome |<strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p>  </p>
        <p>
          <?php endif ?>
  </p>
  <div class="page">
  <p align="right"><b>Total Balance as of today</b> <?php echo date("Y/m/d");?></p>
  <p>
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
							echo "<br />";
							 $wallet_balance=number_format($wallet_balance,2);
																					
  							echo "<p align ='right'><b><font color='white' size='24'> $wallet_balance</font></b></p>";
							
	
									}
						}
	?>
  </p>
  </div>
</div>
		
</body>
</html>