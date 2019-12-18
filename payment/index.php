<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Payment card checkout</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
  
  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
  <div class="tips">
  
  <?php 
  session_start();
 	if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
  
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: ../login.php');
  } 
  
?>
Payment card number: (4) VISA, (51 -> 55) MasterCard, (36-38-39) Laspotech, Ikorodu
</div>

<div class="container">
  <div class="col1">
    <div class="card">
      <div class="front">
        <div class="type">
          <img class="bankid"/>
        </div>
        <span class="chip"></span>
        <span class="card_number">&#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; </span>
        <div class="date"><span class="date_value">MM / YYYY</span></div>
        <span class="fullname">FULL NAME</span>
      </div>
      <div class="back">
        <div class="magnetic"></div>
        <div class="bar"></div>
        <span class="seccode">&#x25CF;&#x25CF;&#x25CF;</span>
        <span class="chip"></span><span class="disclaimer">This card is property of Random Bank of Random corporation. <br> If found please return to Random Bank of Random corporation - 21968 Paris, Verdi Street, 34 </span>
      </div>
    </div>
  </div>
  <form action="index.php" method="post" enctype="multipart/form-data">
  <div class="col2">
  <?php
  	// connect to the database
	$db = mysqli_connect('localhost', 'root', '', 'registration');

/*$query = "SELECT * FROM wallet WHERE id=0";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) == 1) {}*/
		
		
	$Query="SELECT * FROM wallet WHERE id='0'";
				if ($result = $db->query($Query)) {
				while ($row = $result->fetch_assoc()) {	
						//echo "The Below Record was found based on the ID you entered";	
								
								//$result = mysql_query("SELECT * FROM wallet WHERE id=0");
								//while($row = mysql_fetch_array($dbresult))
								//	{	
											$last_payment_amt = $row['last_payment_amt'];
											$email = $row['email'];
																					
   								     	echo "<label>Email</label>";
  	echo "<input name='p_email_display' type='text' value='$email' disabled='disabled'/>";
 	echo " <label>Amount</label>";
  	echo "<input name='p_amount_display' type='text' class='number' onKeyPress='return event.charCode >= 48 && event.charCode <= 57' value ='$last_payment_amt' maxlength='10' ng-model='ncard' disabled='disabled'/> ";
	// The Hidden value of the above
	
	//echo "<label>Email</label>";
  	echo "<input name='p_email' type='hidden' value='$email' />";
 	//echo " <label>Amount</label>";
  	echo "<input name='p_amount' type='hidden' class='number' onKeyPress='return event.charCode >= 48 && event.charCode <= 57' value ='$last_payment_amt' maxlength='10' ng-model='ncard' /> ";
	
									}
						}
	?>
  	<label>Card Number</label>
  	<input name="text" type="text" class="number" onKeyPress='return event.charCode >= 48 && event.charCode <= 57' maxlength="19" ng-model="ncard" required/>
  	<label>Cardholder name</label>
    <input class="inputname" type="text" placeholder="" required/>
    <label>Expiry date</label>
    <input class="expire" type="text" placeholder="MM / YYYY" required/>
    <label>Security Number</label>
    <input class="ccv" type="text" placeholder="CVC" maxlength="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required/>
    <button type="submit" class="buy" name="make_payment"><i class="material-icons">lock</i> Pay --.-- €</button>
    <p>
	<?php
	// connect to the database
	$db = mysqli_connect('localhost', 'root', '', 'registration');
	
	if (isset($_POST['make_payment'])) {
	
	$p_email = mysqli_real_escape_string($db, $_POST['p_email']);
 	 $p_amount = mysqli_real_escape_string($db, $_POST['p_amount']);
	 
	 $inform_user = "UPDATE users SET wallet_balance=wallet_balance+$p_amount,last_payment_amount=$p_amount where email='$p_email'";
	 //$results = mysqli_query($db, $query);
	// $inform_user="update users set hijack_attempt=hijack_attempt+1,hijack_attempt_all=hijack_attempt_all+1 where user_email='$user_email'";
				if(mysqli_query($db,$inform_user))
				{
					$query_upd = "INSERT INTO history (email , amount) VALUES('$p_email', '$p_amount')";
  					mysqli_query($db, $query_upd);
					// =================NOTIFY THE USER ABOUT THE FAILED ATTEMPT=================
					echo "<script>alert('Success!!')</script>";
					echo "<script>window.open('../index.php','_self')</script>";
					//header('location: ../index.php');
					//  $_SESSION['username'] = $username;
					  //$_SESSION['success'] = "Wallet successfully Updated";
					  //header('location: ../index.php');
				exit();
				}
  	
	/*if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "Wallet successfully Updated";
  	  header('location: ../index.php');
  	}else {
  		echo "Wrong email detected";
  	}
	*/

	}
	?>
	</p>
  </div>
  </form>
</div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
