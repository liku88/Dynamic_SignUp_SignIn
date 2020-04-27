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
	<link rel="stylesheet" href="css/login.css">
    <link rel="shorcut icon" type="image/png" href="favicon.png">

	<title>Login Form</title>



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
	    
	    <hr class="divider">
	    <div>
	    <p class="bg-success text-white px-4"><?php 
            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
            }else{
                echo $_SESSION['msg'] = 'You are logged out';
            }
              ?></p>
	    </div>
	    <div class="restcontent">
	        <form method="post"  action="
<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
  <div class="form-group">
   
    <div class="input-group mycus1">
      <div class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
      <input  name="email" type="email" class="form-control" id="exampleInputAmount" placeholder="Email Address" value="<?php if(isset($_COOKIE['emailcookie'])){
    echo $_COOKIE['emailcookie'];
} ?>" required>
      <br>
      
     
    </div>
    <div class="input-group mycus1">
      <div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
      <input  name="password" type="password" class="form-control" id="exampleInputAmount" placeholder="Enter Password" value="<?php if(isset($_COOKIE['passwordcookie'])){
    echo $_COOKIE['passwordcookie'];
} ?>"required> 
      <br>
      
     
    </div>
    
  </div>
  <button type="submit" name="login" class="btn btn-primary mycus2">Login Account</button> <br>
  <div class="mycus1">
      <input  name="rememberme" type="checkbox"> <label  for="">Remember Me</label>
      <br>
      
     
    </div>
     <div class="mycus1">
      <a href="recover.php">Forgot Password ?</a>
      
     
    </div>
</form>
	    </div>
	    <div class="footer">
	        <span>Have not an account? <a href="registration.php">Sign Up</a></span>
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

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $emailverifier = "select * from dynamicreg where email='$email' and status = 'active' ";
    $emailquery = mysqli_query($con, $emailverifier);
    $emailcounter = mysqli_num_rows($emailquery);
    if($emailcounter){
        $emailfetcher = mysqli_fetch_assoc($emailquery);
        $passwordfetcher = $emailfetcher['password'];
        $_SESSION['username'] = $emailfetcher['fullname'];
        
        $passwordverifier = password_verify($password, $passwordfetcher);
        if($passwordverifier){
            
            if(isset($_POST['rememberme'])){
                setcookie('emailcookie',$email,time()+86400);
                setcookie('passwordcookie',$password,time()+86400);

                header('location:home.php');
            }else{
                header('location:home.php');
            }
            
        }else{
            ?>
            <script>alert("Invalid Password"); </script>
            <?php
        }
        
    }else{
        ?>
            <script>alert("Invalid Email"); </script>
            <?php
    }
}




?>
