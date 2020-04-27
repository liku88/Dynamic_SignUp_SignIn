<?php
session_start();
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

	<title>SignUp</title>



	<style>

	</style>

</head>

<body>

	<div class="container">
	
	<div class="content">
	    <div class="header">
	        <h1><strong>Create Account</strong></h1>
	        <h3>Get started with free account</h3>
	        <button type="button" class="btn btn-danger button1"><i class="fa fa-google" aria-hidden="true"></i>  Login via Gmail</button> <br>
	        <button type="button" class="btn btn-primary"><i class="fa fa-facebook" aria-hidden="true"></i>   Login via Facebook</button>
	    </div>
	    
	    <hr class="divider-text">
	    <div class="restcontent">
	        <form action=" 
<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" >
  <div class="form-group">
    <div class="input-group mycus1">
      <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
      <input  name="username" type="text" class="form-control" id="exampleInputAmount" placeholder="Full Name" required>
      <br>
      
     
    </div>
    <div class="input-group mycus1">
      <div class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
      <input  name="email" type="email" class="form-control" id="exampleInputAmount" placeholder="Email Address" required>
      <br>
      
     
    </div>
    <div class="input-group mycus1">
      <div class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></div>
      <input  name="mobile" type="text" class="form-control" id="exampleInputAmount" placeholder="Phone number" required>
      <br>
      
     
    </div>
    <div class="input-group mycus1">
      <div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
      <input  name="password" type="password" class="form-control" id="exampleInputAmount" placeholder="Create Password" required>
      <br>
      
     
    </div>
    <div class="input-group mycus1">
      <div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
      <input  name="cpassword" type="password" class="form-control mycus3" id="exampleInputAmount" placeholder="Repeat Password" required>
      <br>
      
     
    </div>
    
  </div>
  <button type="submit" name="submit" class="btn btn-primary mycus2">Create Account</button>
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
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    
      $pass = password_hash($password, PASSWORD_BCRYPT);
    $cpass = password_hash($cpassword, PASSWORD_BCRYPT);
     $token = bin2hex(random_bytes(15));
   
   
    $emailverifier= "select * from  dynamicreg where email = '$email' ";
    $emailquery = mysqli_query($con,$emailverifier);
    $emailcounter = mysqli_num_rows($emailquery);
    
    
    
    if($emailcounter>0){
        ?>
        <script> alert("Email already exist"); </script>
        <?php
    }else{
        if($password === $cpassword){
            $insert = "insert into dynamicreg (fullname, email, mobile, password, cpassword, token, status) VALUES ('$username','$email','$mobile','$pass','$cpass','$token','inactive')";
            $insertquery = mysqli_query($con, $insert);
            
            $subject = "Account verification";
            $body = "Hi, {$username} This is verification code for account registration http://localhost/dynamiclogin/verification.php?token=$token";
            $headers = "From: rockonliku88@gmail.com";

            if (mail($email, $subject, $body, $headers)) {
             $_SESSION['msg'] = "verification code has being sent check your email at {$email}";
             header('location:login.php');       
            } else {
            ?>
            <script> alert("Email sending failed"); </script>
           <?php
            }

            
        }else{
            ?>
        <script> alert("Password did not match"); </script>
        <?php
        }
    }
    
}


?>
