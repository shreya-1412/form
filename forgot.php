<?php





$emailErr = "";

$sendmail = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){      
    include 'configuration.php' ; 
        
    
       $email = ($_POST['email']);
    
    
     // Check whether this username exists
    $existSql = "SELECT * FROM `users` WHERE email = '$email'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);

    // Check Whether email already exists;
    $existSql1 = "SELECT * FROM `users` WHERE email = '$email'";
    $result1 = mysqli_query($conn, $existSql1);
    $numExistRows1 = mysqli_num_rows($result1);
    $row = mysqli_fetch_array($result1, MYSQLI_ASSOC);
    #echo $row['email'];

    if($numExistRows ){
        
    
                $userdata=mysqli_fetch_array($result);
                $name =$userdata['name'];   
                $token=$userdata['token'];
                    
                
        
                            #$sql = "INSERT INTO `users` ( `email`, `dt`) VALUES ( ', '$email', current_timestamp())";
                            #echo $sql;
                            
                            $to_email = "$email";
                            $subject = "Password Reset $name";
                            $body = "Congratulation $name, Reset Your Password
                            http://localhost/shreya/reset_password.php?token=$token";
                            $headers = "From: shreayuu@gmail.com";
                            #echo $sql;                                    
                            if (mail($to_email, $subject, $body, $headers)) {
                                $sendmail = "Email successfully sent to $to_email...";
                            } else {
                                $sendmail = "Email sending failed...";
                            }
                        }
                    }
                
            else{
                echo"No Email found";
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

<script>  
        function validation()  
        {  
        
            var ps=document.f1.password.value;  
            var em=document.f1.exampleInputEmail1.value;  
            if(id.length=="" && ps.length=="" && em.length == "") {  
                alert("User Name, Email and Password fields are empty");  
                return false;  
            }  
            else  
            {  
                
                if(em.length == ""){
                    alert("Email field is empty");
                    return false;
                }   
                if (ps.length=="") {  
                    alert("Password field is empty");  
                    return false;  
                }
                  
                                    
        }  
    </script>
    

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
<form action = "forgot.php" method = "post" class = "mt-2" name = 'f1' onsubmit = "return validation()">
<center> <strong style = " font-size :30px">Recover Your Account</strong></center>

<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address<span class = "error">*</span></label>
    <input type="text" class="form-control" name = "email">
    <!--  if Email is invalid-->
   
    
</div>



<button type="submit" class="btn btn-primary">Send Email</button> 

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
