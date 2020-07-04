<?php include "header.php"; ?> 
<?php include "menu.php"; ?> 
<!-- ================================================ -->
<?php 

if(!isset($_SESSION['email'])){
    header('Location: login.php');
}

$session_email = $_SESSION['email'];

$query = "SELECT * FROM users WHERE email = '$session_email'";
$run = mysqli_query($con, $query);
$row = mysqli_fetch_array($run);

$image = $row['image'];
$id = $row['user_id'];
$day = date('d', strtotime($row['cdate']));
$mon_year = date('M, Y', strtotime($row['cdate']));
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$username = $row['username'];
$contact_no = $row['contact_no'];
$email = $row['email'];
$role = $row['role'];

?>

<!-- ================================================ -->

<!-- ================================================ -->
<div class="container-fluid w-100 float-left position-relative">
    <div class="row">
        <div class="col-md-3">
            <?php include "side_menu.php"; ?>   
        </div>
        <div class="col-md-9  pd-5 mb-5">                     
            <h1 class="text-primary pt-4 h1-s">
                <i class="fa fa-user"></i> Profile: <small class="text-dark"> Personal Details </small>
            </h1>
            <hr>
            <ol class="breadcrumb bc-s">
                <li><a href="index.php" class="pr-1"><i class="fa fa-tachometer"></i> Dashboard / </a></li>
              <li class="active pl-1"><i class="fa fa-user"></i> Profile </li>
            </ol>
            
                    <form action="" method="post" enctype="multipart/form-data">
                   <div class="row">
                       <div class="col-md-8  ">
                         <div class="container">
                          <div class="row">
                          
                          <div class="card w-100 mt-3">
                        <div class="card-header">
                          <div class="row align-items-center">
                            <div class="col-8">
                              <h3 class="mb-0"> Personal Details </h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="edit_profile.php?edit=<?php echo $id;?>" class="btn btn-primary mt-2">Edit Profile</a>
                                </div>
                          </div>
                        </div>
                        <div class="card-body w-">
                           
                            <h6 class="heading-small text-muted mb-4">User Information</h6>
                            <div class="pl-lg-4">
                             
                              <div class="row">
                               
                                <div class="col-md-6 ">
                                    <h6 class="pb-2 mb-0 text-primary  border-bottom border-primary">First Name</h6>
                                    <p id="first_name" name="first_name" class="form-control"><?php echo $first_name;?></p>
                                </div>
                                <div class="col-md-6 ">
                                    <h6 class="pb-2 mb-0 text-primary  border-bottom border-primary">Last Name</h6>
                                    <p id="last_name" name="last_name" class="form-control"><?php echo $last_name;?></p>
                                </div>
                                <div class="col-md-6 ">
                                    <h6 class="pb-2 mb-0 text-primary  border-bottom border-primary">Username</h6>
                                    <p id="username" name="username" class="form-control"><?php echo $username;?></p>
                                </div>
                                <div class="col-md-6 ">
                                    <h6 class="pb-2 mb-0 text-primary  border-bottom border-primary">Email</h6>
                                    <p id="email" name="email" class="form-control"><?php echo $email;?></p>
                                </div>
                              </div>
                            </div>
                            <hr class="my-4">
                            <!-- Address -->
                            <h6 class="heading-small text-muted mb-4">Contact Information</h6>
                            <div class="pl-lg-4">
                              <div class="row">
                                <div class="col-md-12">
                                  <h6 class="pb-2 mb-0 text-primary  border-bottom border-primary">Contact No:</h6>
                                    <p id="contact_no" name="contact_no" class="form-control"><?php echo $contact_no;?></p>
                                </div>
                              </div>
                            </div>
                            <hr class="my-4">
                            <h6 class="heading-small text-muted mb-4">Other Information</h6>
                            <div class="pl-lg-4">
                             <div class="row">
                                <div class="col-lg-6">
                                  <h6 class="pb-2 mb-0 text-primary  border-bottom border-primary">Role</h6>
                                    <p id="role" name="role" class="form-control"><?php echo $role;?></p>
                                </div>
                                <div class="col-lg-6">
                                   <h6 class="pb-2 mb-0 text-primary  border-bottom border-primary">Date</h6>
                                    <p id="date" name="date" class="form-control"><?php echo $day;?> <?php echo $mon_year;?></p>
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
                               echo "<img src='assets/images/$image' width='100%'>";
                           ?>
                       </div>
                   </div>
            </form>
        </div><!--  .col-md-9/ -->  
    </div>
</div>

       <!-- =========================================================  -->
       
       
       
       <!-- =========================================================  -->

<?php include "footer.php"; ?> 



