<?php

    session_start();

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        header("location: login.php");
        exit;
    }
    else{
        $showAlert = false;
        $showError = false;
        $contactErr = "";
        $email = $_SESSION['email'];
       
          // fetching username to run query
        #echo $username;
        include 'configuration.php' ;
        
        $sql = "SELECT * from `users` where email = '$email'";        // running this query to show data on text area in form
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $num = mysqli_num_rows($result);
                
        if($_SERVER["REQUEST_METHOD"] == "POST"){      
            
            //to prevent from mysqli injection
            function safe($conn,$data){  
                $email = stripcslashes($data);                
                $data = htmlspecialchars($data);
                $email = mysqli_real_escape_string($conn, $data);  
                return $data;  
            }
            
            $name =safe($conn, $_POST['name']);
            $contact =safe($conn, $_POST['contact']);
            $address =safe($conn, $_POST['address']);
            
            if(strlen($contact) != 10 ){
                $contactErr = "Mobile Number's should be 10 digit";
                $result = false;
            }
            else{
                $sql = "UPDATE `users` SET name='$name', contact='$contact', address='$address'  where email = '$email'";
                $result = mysqli_query($conn, $sql);

                if ($result){
                    $showAlert = true;
                }
                            
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

    <title>Profile</title>
    <style>
            .error {color: #FF0000;}
    </style>

    <script>  
            function validation()  
            {  
                var id=document.f1.username.value;  
                var ps=document.f1.password.value;   
                if(id.length=="" && ps.length=="") {  
                    alert(" Email and Password fields are empty");  
                    return false;  
                }  
                else  
                {  
                    if(id.length=="") {  
                        alert("Email is empty");  
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
    <div> <?php require 'das_nav.php'; ?> </div>
  
        <?php
            if($showAlert){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Succeess</strong> Your account has been UPDATED successfuly.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
            if($showError){

                
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error! </strong>' .$showError.'.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }

            
        ?>

    <div class="container mt-4">

        <div >
            <form action = "profile.php" method = "post" class = "mt-2" name = 'f1' onsubmit = "return validation()">
            
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address: </label>
                <strong><?php echo $row['email'] ;?></strong>
                
            </div>
            
            <div class="mb-3">
                <label for="exampleInputText1" class="form-label">Name</label>
                <input type="text" class="form-control" id="exampleInputText" name = "name" value = "<?php echo $row['name'] ;?>" >
            </div>
            
            <div class="mb-3">
                <label for="contact" class="form-label">Mobile Number</label>
                <input type="number" class="form-control" id="contact" name = "contact" value = "<?php echo $row['contact'] ;?>" >
                <span class="error"> <?php echo $contactErr;?></span>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="address" class="form-control" id="address" name = "address" value = "<?php echo $row['address'] ;?>">
            </div>
            <div>
            <button type="submit"  name="submit" class="btn btn-primary">Update</button> 
       
            <button type="button" class="btn btn-primary" onclick = "location.href = 'change_password.php' ">Change Password</button>
            <button type="button" class="btn btn-primary" onclick = "location.href = 'change_email.php' ">Change Email</button>
        </div>
        </br>
            
            
        <button type="button" class="btn btn-primary" onclick = "location.href = 'dashboard.php' ">Cancel</button>
        
            
            
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