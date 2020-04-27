<?php
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/reg.css">
    <link rel="shorcut icon" type="image/png" href="favicon.png">

	<title>Recover</title>



	<style>

	</style>

</head>

<body>

	<div class="container">
	
	<div class="content">
	    <div class="header">
	        <h1><strong>Create Account</strong></h1>
	        <h3>Get started with free account</h3>
	    </div>
	    
	    <hr class="divider-text">
	    <div class="restcontent">
	        <form action=" 
<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" >
  <div class="form-group">
    
    <div class="input-group mycus1">
      <div class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
      <input  name="email" type="email" class="form-control" id="exampleInputAmount" placeholder="Email Address" required>
      <br>
      
     
    </div>
    
  </div>
  <button type="submit" name="submit" class="btn btn-primary mycus2">Recover Account</button>
</form>
	    </div>
	    <div class="footer">
	        <span>Have an account? <a href="login.php">Log in</a></span>
	    </div>
	    
	</div>
	
	
	
	
	
	
	
	

	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<script>
	</script>

</body>

</html>

<?php


include 'connection.php';

if(isset($_POST['submit'])){
   
    $email = mysqli_real_escape_string($con, $_POST['email']);
   
    
   
   
    $emailverifier= "select * from  dynamicreg where email = '$email' ";
    $emailquery = mysqli_query($con,$emailverifier);
    $emailcounter = mysqli_num_rows($emailquery);
    
    
    
    if($emailcounter){
        
        $userdata = mysqli_fetch_array($emailquery);
        $username = $userdata['username'];
        $token = $userdata['token'];
          $subject = "Password Reset";
            $body = "Hi, {$username} This is verification code for password reset http://localhost/dynamiclogin/resetpass.php?token=$token";
            $headers = "From: rockonliku88@gmail.com";

            if (mail($email, $subject, $body, $headers)) {
             $_SESSION['msg'] = "Password recovery code has being sent check your email at {$email}";
             header('location:login.php');       
            } else {
            ?>
            <script> alert("Email sending failed"); </script>
           <?php
            }

    }else{
            
          ?>
            <script> alert("Email does not exist"); </script>
           <?php
            
        }
    }
    



?>
