<?php include "header.php"; ?> 
<?php include "menu.php"; ?> 

<?php
    if(!isset($_SESSION['email'])){
    header('Location: login.php');
    }
    else if(isset($_SESSION['email']) && ($_SESSION['role'] == 'user')){
    header('Location: index.php');
    }
    if(isset($_GET['edit'])){
        $edit_id = $_GET['edit'];
        $edit_query = "SELECT * FROM users WHERE user_id = $edit_id";
        $edit_query_run = mysqli_query($con, $edit_query);
        if(mysqli_num_rows($edit_query_run) > 0){
            $edit_row = mysqli_fetch_array($edit_query_run);
            $e_first_name = $edit_row['first_name'];
            $e_last_name = $edit_row['last_name'];
            $e_contact_no = $edit_row['contact_no'];
            //$e_password = $edit_row['password'];
            //$e_role = $edit_row['role'];
            $e_image = $edit_row['image'];
        }
    }
    else{
        header("location: index.php");
    }
?>


<div class="container-fluid w-100 float-left position-relative">
    <div class="row">
        <div class="col-md-3">
            <?php include "side_menu.php"; ?>   
        </div>
        <div class="col-md-9">
            
            
           
            <h1 class="text-primary pt-4 h1-s">
                <i class="fas fa-user-edit"></i> Edit User: <small class="text-dark"> Edit User Details</small>
            </h1>
            <hr>
            <ol class="breadcrumb bc-s">
                <li><a href="index.php" class="pr-1"><i class="fa fa-tachometer"></i> Dashboard / </a></li>
              <li class="active pl-1"><i class="fas fa-user-edit"></i> Edit User:</li>
            </ol>
             
             <?php
                
                if(isset($_POST['submit'])){
                    $date = time();
                    $ed_first_name = mysqli_real_escape_string($con,$_POST['first_name']);
                    $ed_last_name = mysqli_real_escape_string($con,$_POST['last_name']);
                    //$ed_password = mysqli_real_escape_string($con,$_POST['password']);
                    $ed_contact_no = mysqli_real_escape_string($con,$_POST['contact_no']);
                    //$role = $_POST['role'];
                    $ed_image = $_FILES['image']['name'];
                    $ed_image_tmp = $_FILES['image']['tmp_name'];
                    
                    if(empty($ed_image)){
                            $ed_image = $image;
                        }
                    
                    $salt_query = "SELECT * FROM users ORDER BY user_id DESC LIMIT 1";
                    $salt_run = mysqli_query($con, $salt_query);
                    $salt_row = mysqli_fetch_array($salt_run);
                    $salt = $salt_row['salt'];
                    
                    //$password = crypt($password, $salt);
                    
                    if(empty($ed_first_name) or empty($ed_last_name) or empty($ed_contact_no)){
                        $error = "All (*) Feilds Are Required";
                    }
                    
                    else{
                            $update_query = "UPDATE users SET cdate = '$date' , first_name = '$ed_first_name' , last_name = '$ed_last_name', contact_no = '$ed_contact_no', image = '$ed_image' WHERE user_id = '$edit_id'";
                            
                            if(mysqli_query($con, $update_query)){
                                
                                $msg = "User Has Been Edit Successfully";
                                $path = "assets/images/$up_image";
                                
                                 header("location: edit_user.php?edit=$edit_id");
                                    if(!empty($ed_image)){
                                        if(move_uploaded_file($ed_image_tmp, $path)){
                                        copy($path, "../$path");
                                    }
                    else{
                        $msg = "ERROR";
                        }
                                }
                                    }
                        }
                }
            
             ?>
              
             <form action="" method="post" enctype="multipart/form-data">
                   <div class="row">
                       <div class="col-md-8  ">
                         <div class="container">
                          <div class="row">
                          
                          <div class="card w-100 mt-3">
                        <div class="card-header">
                          <div class="row align-items-center">
                            <div class="col-8">
                              <h3 class="mb-0">Edit User </h3>
                            </div>
                            <div class="col-4 text-right">
                              <input type="submit" value="Update User" name="submit" class="btn btn-primary">
                              
                            </div>
                          </div>
                        </div>
                        <div class="card-body w-">
                           
                            <h6 class="heading-small text-muted mb-4">User Information</h6>
                            <div class="pl-lg-4">
                             
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">First Name</h6>
                                    
                                    <?php
                                        if(isset($error)){
                                            echo "<span class='pull-right' style='color:red;'>$error</span>";
                                        }
                                        else if(isset($msg)){
                                           echo "<span class='pull-right' style='color:green;'>$msg</span>";
                                        }
                                    ?>
                                    
                                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" value="<?php echo $e_first_name;?>">
                                  </div>
                                </div>
                                
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <h6 class="pb-2 mb-0 text-primary  border-bottom border-primary">Last Name</h6>
                                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo $e_last_name;?>">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <hr class="my-4">
                            <!-- Address -->
                            <h6 class="heading-small text-muted mb-4">Contact Information</h6>
                            <div class="pl-lg-4">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <h6 class="pb-2 mb-0 text-primary  border-bottom border-primary">Contact No:</h6>
                                    <input id="contact_no" type="text" name="contact_no" class="form-control" placeholder="Contact No" value="<?php echo $e_contact_no;?>">
                                  </div>
                                </div>
                              </div>
                              
                            </div>
                            
                            <hr class="my-4">
                            <h6 class="heading-small text-muted mb-4">Choose Image</h6>
                            <div class="pl-lg-4">
                             <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <h6 class="pb-2 mb-0 text-primary">Change Profile Image</h6>
                                    <input type="file" id="image" name="image">
                                  </div>
                                </div>
                               
                              </div>
                            </div>
                            
                          
                        </div>
                      </div>
                             </div>
                           </div>
                       </div>
                       <div class="col-md-4">
                           <?php
                               echo "<img src='assets/images/$e_image' width='100%'>";
                           ?>
                       </div>
                   </div>
        <!--  .col-md-9/ -->  
        </form>
    </div>
</div>

       

<?php include "footer.php"; ?> 


<script>
  var check_pass = function(){
    if (document.getElementById('password').value !=
      document.getElementById('confirm_password').value) {
      document.getElementById('match').innerHTML = 'Password is not matching';
      document.getElementById('match').style.color = 'red';
    }
    else{
      document.getElementById('match').innerHTML = 'Password matching';
      document.getElementById('match').style.color = 'green';
    }
  }
</script>