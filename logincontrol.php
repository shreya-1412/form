<?php  
    if($_SERVER["REQUEST_METHOD"] == "POST"){    
        include 'configuration.php' ;  
        
        $email = $_POST['email'];  
        $password = $_POST['password'];  
        
            //to prevent from mysqli injection  
            
            function safe($conn,$data){  
                $email = stripcslashes($data);  
                $email = mysqli_real_escape_string($conn, $data);  
                return $data;  
            }
            
            $email = safe($conn, $email); 
            $password = safe($conn, $password);
            



            // encrypting password
            $checkpassword = md5($password);
            $sql = "SELECT * from users where email = '$email' and password = '$checkpassword' ";  
            $result = mysqli_query($conn, $sql);  
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $num = mysqli_num_rows($result);  
            
            if($num == 1){
                $sql = "SELECT * from users where email = '$email' and `status` = 'active' ";  
                $result1 = mysqli_query($conn, $sql);  
                $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);  
                $num1 = mysqli_num_rows($result1);
                if($num1 == 1){  
                    #echo "<h1><center>Hello ". $row['username'] ." <br> Login successful </center></h1>";
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $email;
                    #$_SESSION['name'] = $row['name'];
                    header("location: dashboard.php",);
                }
                else{
                    echo "your Email account is not varified... please varify your account First";
                }  
            }  
            else{  
                echo "<h1> Login failed. Invalid username or password.</h1>";  
                
            }
        
    }

?> 

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" 
        crossorigin="anonymous">
    </head>
    <body >
        <div> <?php require 'nav.php'; ?></div>

        <center><input class = "btn btn-primary" type="submit" value="GO BACK" onclick = " location.href = 'login.php'"> </center>
        
    </body>
</html>





