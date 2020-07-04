<?php include "header.php"; ?>

<?php 
//$conn = mysqli_connect("localhost","root","","login_register");

if(isset($_POST['submit'])){
	
	    $id = $_REQUEST['user_id'];
        $email = $_REQUEST['email'];
    
        $oldpassword = md5($_POST['oldpassword']);
    
        $newpassword = md5($_POST['newpassword']);
        $confirmpassword = md5($_POST['confirmpassword']);
        
	   $select = "SELECT * FROM users WHERE user_id = '$id' AND email = '$email'";
		$result = mysqli_query($con,$select);
        $count = mysqli_num_rows($result);
        $data = mysqli_fetch_array($result);
        $password = $data['password'];  //  Original code
        //$password = md5($data['password']);
    
        
        if ($oldpassword == $password){

           if ($newpassword == $confirmpassword){
              $update = "UPDATE users SET password = '$newpassword' WHERE email = '$email' AND user_id = '$id'";
                $resultSucc = mysqli_query($con,$update);
                if($resultSucc){
                    $errMsg = '<div class="alert alert-success">Your Password Change Successfully. Can You Log in Now.</div>';
                }
            }
            else{
                $errMsg = '<div class="alert alert-danger">Your New Password And Confirm Password Does Not Match!</div>';
            }
        }
        else {
            $errMsg = '<div class="alert alert-danger">Your Old Password Does Not Match!</div>';
        }
    }
?>


<?php
/* 

    if(isset($_POST['submit'])){
        
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $password = crypt($pass);
            $sql = "SELECT * FROM users WHERE email='$email'";
            $result=mysqli_query($con,$sql);
            $count1 = mysqli_num_rows($result);
        
            if ($count1 > 0)
            {
                $query = "UPDATE users SET password = '$password' where email = '$email'";

                if(mysqli_query($con, $query)){

                       header("location: recover_password.php?status=succ");
                    }
                    else{ header("location: recover_password.php?status=ERR");}
                }
                
            
            else{ 
                header("location: recover_password.php?status=Err");
            } 
    }*/
?>    
<!-- Mirrored from coderthemes.com/ubold/layouts/light/pages-recoverpw.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Aug 2019 19:18:16 GMT -->

    <body class="bg-primary">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <!--<a href="index.html">
                                        <span><img src="assets/images/logo-dark.png" alt="" height="22"></span>
                                    </a>-->
                                    <a class="text-primary font-weight-bold" href="index.php">
                                        <h3 class="m-0"><i class="fas fa-users"></i> MPS </h3>
                                    </a>
                                    <p class="text-muted mb-4 mt-3">Enter your Old, New And Confirm Password then we will Change your password.</p>
                                </div>
                                
                                 <?php if (isset($msg)) { echo $msg; } ?>
                                 <?php if (isset($errMsg)) { echo $errMsg; } ?>

                                <form action="change_password.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                                    <input type="hidden" name='user_id' value="<?php echo $_REQUEST['user_id'];?>" />
                                    <input type="hidden" name='email' value="<?php echo $_REQUEST['email'];?>" />
                                    
                                    <div class="form-group mb-3">
                                      
                                      
                                        <label for="newpassword">Old Password</label>
                                        <input class="form-control" type="password" id="oldpassword" required="" placeholder="Enter Your Old Password" name="oldpassword">
                                        
                                        <label for="newpassword">New Password</label>
                                        <input class="form-control" type="password" id="newpassword" required="" placeholder="Enter Your New Password" name="newpassword">
                                        
                                        <label for="confirmpassword">Confirm Password</label>
                                        <input class="form-control" type="password" id="confirmpassword" required="" placeholder="Enter Your Confirm Password" name="confirmpassword" onkeyup='check_pass();'>
                                        <span id="match"></span>
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit" name="submit"> Submit </button>
                                    </div>

                                </form>
                                
                                <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-black-50">Back to <a href="login.php" class="text-black ml-1"><b>Log in</b></a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        
    </body>

<!-- Mirrored from coderthemes.com/ubold/layouts/light/pages-recoverpw.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Aug 2019 19:18:16 GMT -->

<?php include "footer.php"; ?>


<script>/*
  var check_pass = function(){
    if (document.getElementById('newpassword').value !=
      document.getElementById('confirmpassword').value) {
      document.getElementById('match').innerHTML = 'Password is not matching';
      document.getElementById('match').style.color = 'red';
    }
    else{
      document.getElementById('match').innerHTML = 'Password matching';
      document.getElementById('match').style.color = 'green';
    }
  }*/
</script>
