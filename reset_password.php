<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    </head>
    <body>
       <?php
            include_once "configuration.php";
            
            if(isset($_POST['submit'])){

                if(isset($_GET['token'])){
                    $token = $_GET['token'];

                    $password = mysqli_real_escape_string($conn, $_POST['password']);
                    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
                   
                    $pass = md5($password);

                    if ($password==$cpassword) {
                        $updatesql= "UPDATE `users` SET `password` = '$pass' WHERE `token` = '$token'";
                        echo"$updatesql";
                        $updatequery = mysqli_query($conn, $updatesql);

                        if($updatequery){
                            $_SESSION['msg'] = "Your password has been updated";
                            header("location:login.php");
                        }
                        else{
                            $_SESSION['msg'] = "update error";
                            header("location:reset_password.php?token=$token");
                        }
                    }

                    else
                    {
                        $err = "Password does'nt match";
                    }
                }
                else{
                    $err = "Invalid Token";
                }
            }


    ?>
    <!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">


<style>
        .error {color: #FF0000;}
</style>


    

</head>
<body>
<div> <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">GingerWebs</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link active" href="login.php">Login</a>
          <a class="nav-link active" href="signup.php">Signup</a>
          
          <!--<a class="nav-link" href="#">Pricing</a>-->
          
          </div>
      </div>
    </div>
  </nav> </div>


<div class="container mt-4">
<!--
<button class="btn btn-primary" type="button" onclick= "location.href ='login.php'">Login</button> 

or
<button class="btn btn-primary" type="button" >SignUp</button>
-->

<div >
<form action = "" method = "post" class = "mt-2" name = 'f1' onsubmit = "return validation()">
<center> <strong style = " font-size :30px">Reset Your Password</strong></center>
<div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">New Password<span class = "error">*</span></label>
    <input type="password" class="form-control" id="exampleInputPassword1" name = "password">
</div>
<div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name = "cpassword">
</div>





<button type="submit" name="submit"class="btn btn-primary">Submit</button> 

</form>
</div>

</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
-->
</body>
</html>

        
        










