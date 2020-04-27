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
    <link rel="stylesheet" href="css/reset.css">
    <link rel="shorcut icon" type="image/png" href="favicon.png">

	<title>Reset Password</title>



	<style>

	</style>

</head>

<body>

	<div class="container">
	
	<div class="content">
	    
	    <div class="restcontent">
	        <form action="" method="post"  class="rest">
  <div class="form-group">
    <div class="input-group mycus1">
      <div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
      <input  name="password" type="password" class="form-control" id="exampleInputAmount" placeholder="Enter new Password" required>
      <br>
      
     
    </div>
    <div class="input-group mycus1">
      <div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
      <input  name="cpassword" type="password" class="form-control mycus3" id="exampleInputAmount" placeholder="Repeat Password" required>
      <br>
      
     
    </div>
    
  </div>
  <button type="submit" name="submit" class="btn btn-primary mycus2">Update Password</button>
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
        if(isset($_GET['token'])){
        $token = $_GET['token'];
         $password = mysqli_real_escape_string($con, $_POST['password']);
         $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    
         $pass = password_hash($password, PASSWORD_BCRYPT);
         $cpass = password_hash($cpassword, PASSWORD_BCRYPT);
   
          if($password === $cpassword){
          
        $upadtepass = "update dynamicreg set password = '$pass' where token='$token' ";
        $updatequery = mysqli_query($con, $upadtepass);
         
        $_SESSION['msg'] = "Your password is updated, login now";
        header('location:login.php');      
          
            
        }else{
            ?>
        <script> alert("Password did not match"); </script>
        <?php
        }
    }else{
            ?>
            <script>alert("Password Update fail");</script>
            <?php
            header('location:resetpass.php');
        }
    
}



?>
