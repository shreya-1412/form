
<?php


$showAlert = false;
$showError = false;
$emailErr = "";
$contactErr = "";
$sendmail = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){      
    include 'configuration.php' ; 
    $conn = $conn; 
    
    
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];  
    
    //to prevent from mysqli injection
    function safe($conn,$data){  
        $username = stripcslashes($data);

        $username = mysqli_real_escape_string($conn, $data);  
        return $data;  
    }

    # Email validation 
    
    if (empty( $email )) {
        $emailErr = "Email is required";
        }
    else {
        $email = safe($conn, $email);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    
    $password = safe($conn, $password);
    $cpassword =safe($conn, $cpassword);
    $name =safe($conn, $name);
    $contact =safe($conn, $contact);
    $address =safe($conn, $address);
    
    $token = bin2hex(random_bytes(15)); // intiallising random token nunmber.

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

    if($numExistRows > 0){
        $showError = "Username Already Exists";
    }
    elseif($numExistRows1 > 0){
        $showError = "Email Already Exists";
    }
    else{
        if(($password == $cpassword)){
            if(!$emailErr){
                // Password Encryption
                $encrypted = md5($password);
                    
                    
                
                    
                    if($password == ""){
                        $showError = "password should not be empty!!!";
                        $result = false;
                    }
                    else {
                        if(strlen($contact) != 10 ){
                            $contactErr = "Mobile Number's should be 10 digit";
                            $result = false;
                        }
                        else{
                            #$sql = "INSERT INTO `users` (  `password`, `email`, `dt`) VALUES ( '$encrypted', '$email', current_timestamp())";
                            #echo $sql;
                            $sql = "INSERT INTO `users` ( `password`, `email`, `name`, `contact`, `address`, `dt`, `token`, `status`) VALUES ( '$encrypted', '$email', '$name', '$contact', '$address', current_timestamp(), '$token', 'inactive') ";
                            $result = mysqli_query($conn, $sql);
                            $to_email = "$email";
                            $subject = "Account Created $name";
                            $body = "Congratulation $name, Your account has been created
                            http://localhost/shreya/authenticate.php?token=$token";
                            $headers = "From: shreayuu@gmail.com";
                            #echo $sql;                                    
                            if (mail($to_email, $subject, $body, $headers)) {
                                $sendmail = "Email successfully sent to $to_email...";
                            } else {
                                $sendmail = "Email sending failed...";
                            }
                        }
                    }
                
            }
            else{
                $result = false;
            }

            if ($result){
                $showAlert = true;
            }
            else{
                $showError = "data not inserted in database";
            }
        }
        else{
            $showError = "Passwords do not match";
        }
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

<title>Sign UP</title>
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
        }  
    </script>
    

</head>
<body>
<div> <?php require 'nav.php'; ?> </div>

<?php
    if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Succeess</strong> Your account hase been created successfuly.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    if($showError){

        
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error! </strong>' .$showError.'.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }

    echo $sendmail;

    
?>

<div class="container mt-4">
<!--
<button class="btn btn-primary" type="button" onclick= "location.href ='login.php'">Login</button> 

or
<button class="btn btn-primary" type="button" >SignUp</button>
-->

<div >
<form action = "signup.php" method = "post" class = "mt-2" name = 'f1' onsubmit = "return validation()">
<center> <strong style = " font-size :30px">SignUp</strong></center>

<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address<span class = "error">*</span></label>
    <input type="text" class="form-control" name = "email">
    <!--  if Email is invalid-->
    <span class="error"> <?php echo $emailErr;?></span>
    
</div>
<div class="mb-3">
    <label for="exampleInputText1" class="form-label">Name</label>
    <input type="text" class="form-control" id="exampleInputText" name = "name">
</div>

<div class="mb-3">
    <label for="contact" class="form-label">Mobile Number</label>
    <input type="number" class="form-control" id="contact" name = "contact" maxlength="10">
    <span class="error"> <?php echo $contactErr;?></span>
</div>
<div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <input type="address" class="form-control" id="address" name = "address">
</div>
<div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password<span class = "error">*</span></label>
    <input type="password" class="form-control" id="exampleInputPassword1" name = "password">
</div>
<div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name = "cpassword">
</div>


<button type="submit" class="btn btn-primary">Submit</button> 

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







