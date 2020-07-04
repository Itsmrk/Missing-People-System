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

    $query = "SELECT * FROM posts WHERE post_id = $edit_id";
    $run = mysqli_query($con, $query);
    $row = mysqli_fetch_array($run);
    $id = $row['post_id'];
}
    if(isset($_GET['view_id'])){
    $edit_id = $_GET['view_id'];
    if($session_role == 'admin' || $session_role == 'user'){
        $get_query = "SELECT * FROM posts WHERE post_id = $edit_id";
        $get_run = mysqli_query($con, $get_query);
      
    }
    
    if(mysqli_num_rows($get_run) > 0){

        $get_row = mysqli_fetch_array($get_run);
        $title = $get_row['title'];
        $image = $get_row['image'];
        $status = $get_row['status'];
        $categories = $get_row['categories'];
        $gender = $get_row['gender'];
        $countries = $get_row['countries'];
        $states = $get_row['states'];
        $cities = $get_row['cities'];
        $person_name = $get_row['person_name'];
        $age = $get_row['age'];
        $contact_no = $get_row['contact_no'];
        $address = $get_row['address'];
        $missing_date = $get_row['missing_date'];
        
    }
    else{
        header('location: posts.php');
    }
}
else{
    header('location: posts.php');
}
?>


<div class="container-fluid w-100 float-left position-relative">
    <div class="row">
        <div class="col-md-3">
            <?php include "side_menu.php"; ?>   
        </div>
        <div class="col-md-9">
             <h1 class="text-primary pt-4">
                <i class="fas fa-file-signature"></i> View Selected Post: <small>Post Detail</small>
            </h1>
            <hr>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard / </a></li>
                    <li class="active pl-1"><i class="fas fa-file-signature"></i> Selected Post </li>
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
                              <h3 class="mb-0"> View Selected Post Details </h3>
                            </div>
                             <div class="col-4 text-right">
                             <a href="edit_post.php?edit=<?php echo $id;?>" class="btn btn-primary mt-2">Edit Post</a>
                            </div>
                          </div>
                        </div>
                        <div class="card-body w-">
                          
                          <div class="pl-lg-4">
                             <div class="row">
                                <div class="col-lg-6">
                                  <h6 class="heading-small text-muted mb-4">Post Type</h6>
                                  <div class="form-group">
                                    <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Categories:</h6>
                                           <p id="categories" name="categories" class="form-control"><?php echo $categories;?></p>
                                           
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <h6 class="heading-small text-muted mb-4">Missing Since</h6>
                                  <div class="form-group">
                                    <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Missing Date:</h6>
                                       <p id="" name="missing_date" type="date" class="form-control"><?php echo $missing_date;?></p>
                                  </div>
                                </div>
                              </div>
                            </div>
                           <hr class="my-4">
                            <h6 class="heading-small text-muted mb-4">User Information</h6>
                            
                            <div class="pl-lg-4">
                             
                              <div class="row">
                                <div class="col-lg-6">
                                   <div class="form-group">
                                    <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Title:*</h6>
                                    <p id="" name="title" class="form-control"><?php echo $title;?></p>
                                    </div>
                                </div>
                                
                                
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Person Name:</h6>
                                     <p id="person" name="person_name" class="form-control"><?php echo $person_name;?></p>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Gender:</h6>
                                           <p id="gender" name="gender" class="form-control"><?php echo $gender;?></p>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Age:</h6>
                                     <p id="age" name="age" class="form-control"><?php echo $age;?></p>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <hr class="my-4">
                            <!-- Address -->
                            <h6 class="heading-small text-muted mb-4">Contact Information</h6>
                            <div class="pl-lg-4">
                              <div class="row">
                                
                                <div class="col-lg-4">
                                  <div class="form-group">
                                   <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Countries:</h6>
                                   <p id="countries" name="countries" class="form-control"><?php 
                                    $Res_C = mysqli_query($con, "SELECT country_name from countries where country_id = ". $countries);
                                    $Row_C = mysqli_fetch_array($Res_C); echo $Row_C[0];
                                ?></p>
                                  </div>
                                </div>
                                
                                <div class="col-lg-4">
                                   <div class="form-group">
                                        <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">States:</h6>
                                           <p id="states" name="states" class="form-control"><?php 
                                    $Res_C = mysqli_query($con, "SELECT state_name from states where state_id = ". $states);
                                    $Row_C = mysqli_fetch_array($Res_C); echo $Row_C[0];
                                ?></p>
                                   </div>
                                </div>
                                
                                <div class="col-lg-4">
                                   <div class="form-group">
                                        <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Cities:</h6>
                                           <p id="cities" name="cities" class="form-control"><?php 
                                    $Res_C = mysqli_query($con, "SELECT city_name from cities where city_id = ". $cities);
                                    $Row_C = mysqli_fetch_array($Res_C); echo $Row_C[0];
                                ?></p>
                                   </div>
                                </div>
                                
                                <div class="col-lg-6">
                                  <div class="form-group">
                                     <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Contact No:</h6>
                                           <p id="contact" name="contact_no" class="form-control"><?php echo $contact_no;?></p>
                                  </div>
                                  
                                </div>
                                <div class="col-lg-12 text-left">
                                  <div class="form-group">
                                    <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Address:</h6>
                                    <p id="address" name="address" class="form-control"><?php echo $address;?></p>
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
                               echo "<img src='assets/images/$image' width='100%'>";
                           ?>
                       </div>
                   </div>
               </form>
        </div>
    </div>
</div>


<?php include "footer.php"; ?>