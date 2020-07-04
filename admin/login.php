<?php
    include "header.php"; 
?>

 <?php 
	//require('PHPMailer/PHPMailerAutoload.php'); 
	//require('crediantial.php');

  ?>
   
   <script>
	  AOS.init();
	</script>
   
<?php

if(isset($_POST['submit'])){ 
    
    $email = mysqli_real_escape_string($con,strtolower($_POST['email']));
    $password = mysqli_real_escape_string($con,$_POST['password']);
    $password = md5($password);
    
    $check_email_query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND status = 'Active'";
     
    $check_email_run = mysqli_query($con, $check_email_query);
    
    $result = mysqli_query($con,$check_email_query);
	$count = mysqli_num_rows($result);
	$data = mysqli_fetch_array($result);
    
    if(mysqli_num_rows($check_email_run) > 0){
        $row = mysqli_fetch_array($check_email_run);
        
        $db_email = $row['email'];
        $db_password = $row['password'];
        $db_role = $row['role'];
        $db_image = $row['image'];
        
      //  $password = crypt($password, $db_password);
        
    
        if($email == $db_email && $password == $db_password){
            header('Location: ../index.php');    //  ../
            $_SESSION['email'] = $db_email;
            $_SESSION['role'] = $db_role;
            $_SESSION['image'] = $db_image;
            
        }
        else{
            header("Location: login.php?status=ERR");
        }
    }
    else{
        $error = "Wrong Username or Password";
    }
}

/*
if(isset($_POST['submit'])){
    
    $email = mysqli_real_escape_string($con,strtolower($_POST['email']));
    $password = mysqli_real_escape_string($con,$_POST['password']);
    
    $check_email_query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";// AND status = 'Active'
    $check_email_run = mysqli_query($con, $check_email_query);
    
    $result = mysqli_query($con,$check_email_query);
	$count = mysqli_num_rows($result);
	$data = mysqli_fetch_array($result);
    
    if(mysqli_num_rows($check_email_run) > 0){
        $row = mysqli_fetch_array($check_email_run);
        
        $db_email = $row['email'];
        $db_password = $row['password'];
        $db_role = $row['role'];
        $db_image = $row['image'];
        //$db_user_image = $row['image'];
        
      //  $password = crypt($password, $db_password);
    
        if($email == $db_email && $password == $db_password){
            header('Location: index.php');    //  ../
            $_SESSION['email'] = $db_email;
            $_SESSION['role'] = $db_role;
            $_SESSION['image'] = $db_image;
            //$_SESSION['user_image'] = $db_user_image;
            
        }
        else{
            header("Location: login.php?status=ERR");
        }
    }
    else{
        $error = "Wrong Username or Password";
    }
}
*/
?> 

    <body class="bg-primary">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <a class="text-primary font-weight-bold" href="index.php">
                                        <h3 class="m-0"><i class="fas fa-users"></i> MPS </h3>
                                    </a>
                                    
                                    <p class="text-muted mb-4 mt-3">Enter your email address and password to access admin panel.</p>
                                </div>
                                
                                <?php// if (isset($msg)) { echo $msg; } ?>
                                
                                <?php if(isset($_GET["status"])){

                                                if($_GET["status"] == "ERR"){?>
                                                    <div class="alert alert-danger" role="alert" style="height: 50px !important">
                                                 <?php echo "<p style='color:red;'><strong>Error: </strong>incorrect username or password</p>";?></div>
                                                 <?php
                                                }      
                                          }
                                    ?>
                                <form action="login.php" method="post">

                                    <div class="form-group mb-3">
                                        <label for="inputEmail">Email</label>
                                        <input class="form-control" type="email" id="inputEmail" name="email" required autofocus placeholder="Email">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" required="" id="inputPassword" name="password" placeholder="Enter Your Password">
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                                            <label class="custom-control-label" for="checkbox-signin" 
                                                 <?php
                                                  if(isset($error)){
                                                      echo "$error";
                                                  }
                                                  ?> >
                                                  Remember me
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit" name="submit" value="Log In"> Log In </button>
                                    </div>

                                </form>

                     
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p> <a href="forgot_password.php" class="text-black-50 ml-1">Forgot your password?</a></p>
                                <p class="text-black-50">Don't have an account? <a href="register.php" class="text-black ml-1"><b>Sign Up</b></a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


 <?php include "footer.php"; ?> 
 
<script src="js/aos.js"></script>
<script>
  AOS.init({
    easing: 'ease-in-out-sine'
  });
</script>