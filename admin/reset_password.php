<?php include "header.php"; ?>
<?php 
	require('PHPMailer/PHPMailerAutoload.php'); 
	require('crediantial.php');
	//include "../connect.php";
?>

<?php 
//$conn = mysqli_connect("localhost","root","","login_register");

if(isset($_POST['submit'])){
	
	$email = $_POST['email'];

		$select = "SELECT * FROM users WHERE email = '$email'";
		$result = mysqli_query($con,$select);
        $count = mysqli_num_rows($result);
        $data = mysqli_fetch_array($result);
    
        $emailData = $data['email'];
        $usernamelData = $data['username'];
        $idData = $data['user_id'];
    
        $url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/5/MPFRSproj_v3/MPFRSproj/admin/change_password.php?user_id='.$idData.'&email='.$emailData;
    //echo base64_encode($url);
    
        $output = 'Hi, Please Click This Link To Change Your Password.<br>'.$url;
    
        if ($email == $emailData){
            
            $mail = new PHPMailer();
			$mail->isSMTP();  
			//$mail->SMTPDebug = 2;                                   // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  					// Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = EMAIL;                 		// SMTP username
			$mail->Password = PASS;                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			$mail->setFrom(EMAIL, 'Localhost');
			$mail->addAddress($email, $emailData);     // Add a recipient
			
			//$mail->addAddress('ellen@example.com');               // Name is optional
			//$mail->addReplyTo('info@example.com', 'Information');
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');

			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');         // Add attachments
			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			
			
			$mail->isHTML(true);

			$mail->Subject = 'Reset Password';
			$mail->Body    = $output;
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			if(!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				$msg = '<div class="alert alert-success">Message Has Been Sent Please Check Your Email.</div>';
				//$msg = '<div class="alert alert-success">Message Has Been Sent Please Check Your Email.</div>';
			}
        }
        else{
            $errMsg = '<div class="alert alert-success">Your Email Address Invalid!</div>';
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
                                        <h3 class="m-0"><i class="fas fa-users"></i> MPFRS </h3>
                                    </a>
                                    <p class="text-muted mb-4 mt-3">Enter Your Email Address Then We Will Reset Your Password.</p>
                                </div>
                                
                                <?php if (isset($msg)) { echo $msg; } ?>
                                <?php if (isset($errMsg)) { echo $errMsg; } ?>

                                <form action="reset_password.php" method="POST" enctype="multipart/form-data" autocomplete="off">

                                    <div class="form-group mb-3">
                                      
                                      
                                        <label for="emailaddress">Email address</label>
                                        <input class="form-control" type="email" id="email" required="required" placeholder="Enter your email" name="email">
                                        
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
