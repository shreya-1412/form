<?php
    $oldErr = "";
    $matchErr = ""; 
    $showAlert = "";
    $id='id';
    session_start();

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        header("location: login.php");
        exit;
    }
    
    else{
        
       
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            
            include 'configuration.php';
            
            //to prevent from mysqli injection
            function safe($conn,$data){  
                $oemail = stripcslashes($data);                
                $data = htmlspecialchars($data);
                $oemail = mysqli_real_escape_string($conn, $data);  
                return $data;  
            }
            
            $oemail = safe($conn, $_POST['oemail']);
            $nemail = safe($conn, $_POST['nemail']);
            $cemail = safe($conn, $_POST['cemail']);
            $token = bin2hex(random_bytes(15)); // intiallising random token nunmber

            $sql = "select * from users where id = '$id'";
            $result = mysqli_query($conn, $sql);  
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $num = mysqli_num_rows($result);

            
                
                if($nemail == $cemail){
                    
                    if($nemail == ""){
                        $matchErr = "New Email should not be empty....";
                    }
                    else{
                        
                        $sql = "UPDATE `users` SET email = '$nemail' where email= '$oemail'";
                        #$sql = "UPDATE `users` SET `password` = '$npassword' WHERE `username` = '$username';";
                        $result = mysqli_query($conn, $sql);
                        $to_email = "$nemail";
                            $subject = "Email Updated $nemail";
                            $body = "Congratulation $nemail, Your Email has been Updated
                            http://localhost/shreya/authenticate.php?token=$token";
                            $headers = "From: shreayuu@gmail.com";
                            #echo $sql;                                    
                            if (mail($to_email, $subject, $body, $headers)) {
                                $sendmail = "Email successfully sent to $to_email...";
                            } else {
                                $sendmail = "Email sending failed...";
                            }
                        if($result){
                            $showAlert = true;
                        }
                    }
                }
                else{
                    $matchErr = "Email do not match....";
                }
            }
            else{
                $oldErr = "Please enter correct Email...";
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

        
        <style>
            .error {color: red;}
    </style>
    </head>
    <body>
        <div> <?php require 'das_nav.php'; ?></div>

        <?php 
            if($showAlert){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Succeess</strong> Your Email Address has been Updated successfuly.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
        ?>
            <div class="container">
            <?php echo "<h1><center>  Update Your Email  </center></h1>"; ?>
           
            <form action = "change_email.php" method = "post" class = "mt-2">
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Old Email<span class = "error">*</span></label>
                    <input type="email" class="form-control" id="exampleInputemail1" name = "oemail">
                    <span class="error"> <?php echo $oldErr;?></span>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">New Email<span class = "error">*</span></label>
                    <input type="email" class="form-control" id="exampleInputemail1" name = "nemail">
                    <span class="error"> <?php echo $matchErr;?></span>
                </div>
                <div class="mb-3">
                    <label for="exampleInputemail1" class="form-label">Confirm Email</label>
                    <input type="email" class="form-control" id="exampleInputemail1" name = "cemail">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Update Email</button>
                <button type="button" class="btn btn-primary" onclick = "location.href = 'dashboard.php' ">Cancel</button>
            </form>
             
            
        </div>

    </body>
</html>