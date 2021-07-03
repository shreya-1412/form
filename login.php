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

    <title>Login</title>

    <script>  
            function validation()  
            {  
                var id=document.f1.username.value;  
                var ps=document.f1.password.value;  
                if(id.length=="" && ps.length=="") {  
                    alert("Email and Password fields are empty");  
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
    <div> <?php require 'nav.php'; ?> </div>
    <div class="container mt-3" style = "" >
    
    <!--<button type="text" class="btn btn-primary" >login</button> 
     or
    <a href="signup.php">
    <button type="text" class="btn btn-primary" >SignUp</button> 
    </a>
        -->
    <br><br>
    <center><strong style = " font-size :30px">Login</strong></center>
    <?php  
         
        //if(session_start()){ 
           // echo ($_SESSION['msg']); 
           // unset($_SESSION['msg']);
           // session_destroy();
      //  }
        
    ?>

    <form name="f1" action = "logincontrol.php" onsubmit = "return validation()" method = "POST">
        <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            <br>
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password"><br>
        <input class = "btn btn-primary" type="submit" value="Submit">
        <a href = "forgot.php"><input type="button"class="btn btn-primary" value ="Forgot Password"></a>
    </form>
    </div>

      

</body>
</html>