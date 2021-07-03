<?php
    $oldErr = "";
    $matchErr = ""; 
    $showAlert = "";
    session_start();

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        header("location: login.php");
        exit;
    }
    
    else{
        $email = $_SESSION['email'];
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            
            include 'configuration.php';
            
            //to prevent from mysqli injection
            function safe($conn,$data){  
                $email = stripcslashes($data);                
                $data = htmlspecialchars($data);
                $email = mysqli_real_escape_string($conn, $data);  
                return $data;  
            }

            $opassword = safe($conn, $_POST['opassword']);
            $npassword = safe($conn, $_POST['npassword']);
            $cpassword = safe($conn, $_POST['cpassword']);

            $sql = "select * from users where email = '$email'";
            $result = mysqli_query($conn, $sql);  
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $num = mysqli_num_rows($result);

            if(md5($opassword) == $row['password']){
                
                if($npassword == $cpassword){
                    
                    if($npassword == ""){
                        $matchErr = "New Password should not be empty....";
                    }
                    else{
                        $encrypted = md5($npassword);
                        $sql = "update `users` SET password = '$encrypted' where email = '$email'";
                        #$sql = "UPDATE `users` SET `password` = '$npassword' WHERE `username` = '$username';";
                        $result = mysqli_query($conn, $sql);
                        if($result){
                            $showAlert = true;
                        }
                    }
                }
                else{
                    $matchErr = "Password do not match....";
                }
            }
            else{
                $oldErr = "Please enter correct password...";
            }

        }

    }

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

        <title>Dashboard</title>
        <style>
            .error {color: red;}
    </style>
    </head>
    <body>
        <div> <?php require 'das_nav.php'; ?></div>

        <?php 
            if($showAlert){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Succeess</strong> Your Password has been Updated successfuly.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
        ?>
            <div class="container">
            <?php echo "<h1><center>  For user: $email </center></h1>"; ?>
            <?php #echo "email = "?>
            <form action = "change_password.php" method = "post" class = "mt-2">
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Old Password<span class = "error">*</span></label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name = "opassword">
                    <span class="error"> <?php echo $oldErr;?></span>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">New Password<span class = "error">*</span></label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name = "npassword">
                    <span class="error"> <?php echo $matchErr;?></span>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name = "cpassword">
                </div>
                <button type="submit" class="btn btn-primary">Update password</button>
                <button type="button" class="btn btn-primary" onclick = "location.href = 'dashboard.php' ">Cancel</button>
            </form>
             
            
        </div>

    </body>
</html>