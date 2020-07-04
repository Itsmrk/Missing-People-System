<?php include "header.php"; ?> 
<?php include "menu.php"; ?> 
<?php
    if(!isset($_SESSION['email'])){
    header('Location: login.php');
    }
?>
<?php
    $session_email = $_SESSION['email'];
    $session_role = $_SESSION['role'];
    //$session_user_image = $_SESSION['user_image'];

if(isset($_GET['view_id'])){
    $edit_id = $_GET['view_id'];

    $query = "SELECT * FROM users WHERE user_id = $edit_id";
    $run = mysqli_query($con, $query);
    $row = mysqli_fetch_array($run);
    $id = $row['user_id'];
}
    if(isset($_GET['view_id'])){
    $edit_id = $_GET['view_id'];
    if($session_role == 'admin' || $session_role == 'user'){
        $get_query = "SELECT * FROM users WHERE user_id = $edit_id";
        $get_run = mysqli_query($con, $get_query);
      
    }
    
    if(mysqli_num_rows($get_run) > 0){

        $get_row = mysqli_fetch_array($get_run);
        /*$image = $get_row['image'];
        $id = $get_row['user_id'];
        $day = date('d', strtotime($row['cdate']));
        $mon_year = date('M, Y', strtotime($row['cdate']));
        $first_name = $get_row['first_name'];
        $last_name = $get_row['last_name'];
        $username = $get_row['username'];
        $contact_no = $get_row['contact_no'];
        $email = $get_row['email'];
        $role = $get_row['role'];*/
        
        
        
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

        
    }
    else{
        header('location: users.php');
    }
}
else{
    header('location: users.php');
}
?>


<div class="container-fluid w-100 float-left position-relative">
    <div class="row">
        <div class="col-md-3">
            <?php include "side_menu.php"; ?>   
        </div>
        <div class="col-md-9">
             <h1 class="text-primary pt-4">
                <i class="fas fa-file-signature"></i> View User: <small>View User Detail</small>
            </h1>
            <hr>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard / </a></li>
                    <li class="active pl-1"><i class="fas fa-file-signature"></i> Selected User </li>
                </ol>
            </nav>  
                
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
                                <a href="edit_user.php?edit=<?php echo $id;?>" class="btn btn-primary mt-2">Edit User</a>
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
        </div>
    </div>
</div>

<?php include "footer.php"; ?>