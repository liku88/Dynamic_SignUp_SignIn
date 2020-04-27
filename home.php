<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RoseBank Gym</title>
    <link rel="stylesheet" href="css/gym.css">
    <link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="shorcut icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
   <div>
       <h1><i class="fa fa-cog" aria-hidden="true"></i> <br>RoseBank Gym</h1>
       <p>Hey how are you <?php echo $_SESSION['username'];   ?></p>
       <button>Call us +919040288467</button>
       <a href="logout.php">Log Out</a>
   </div>
    
</body>
</html>