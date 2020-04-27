<?php
session_start();

include 'connection.php';

if(isset($_GET['token'])){
    $token = $_GET['token'];
    
    $update = "update dynamicreg set status ='active' where token = '$token' ";
    
    $updatequery = mysqli_query($con, $update);
    
    if($updatequery){
        if(isset($_SESSION['msg'])){
            $_SESSION['msg'] = 'Email is verified now login.';
            header('location:login.php');
        }else{
             $_SESSION['msg'] = 'You are logged out';
            header('location:login.php');
        }
    }else{
         $_SESSION['msg'] = 'Email is not verified.';
            header('location:registration.php');
    }
}

?>