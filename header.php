<?php 
ob_start();
session_start();
error_reporting(0);
?>

 <?php
    $session_role = $_SESSION['role'];
    

if($session_role=='admin' || $session_role == 'user')
{
    $session_email = $_SESSION['email'];
    $session_image = $_SESSION['image'];
    $session_username = $_SESSION['username'];
}
?>
 

<?php include "connect.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-grid.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-reboot.min.css">
	<!-- fontawesome -->
    <link rel="stylesheet" type="text/css" href="assets/css/all.min.css">
    <!-- custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- favicon.ico  -->
    <link rel="icon" type="image/png" href="assets/images/favicon.ico">
	<!-- title -->
   
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
   
   
    <title> MPS </title>
    
</head>
<body>

<div class="w-100 fixed-top">

  <div class="bg-primary">
   <div class="container py-2 relative  ">
      <div class="row">
       <div class="col-6 col-sm-6 col-xs-6 col-md-6 text-white">
           <a href="tel:+923249503869" class="text-secondary"><small class="text-white">+92(51)111-111-3</small></a> | 
           <a href="mailto:info@mps.com" class="text-secondary"><small class="text-white">Info@mps.com</small></a>
        </div>
         <div class="col-6 col-sm-6 col-md-6 text-white text-right">
           <a href="https://www.facebook.com/" class="text-white pt-1"><i class="fab fa-facebook-square"></i></a> | 
           <a href="https://www.instagram.com/?hl=en" class="text-white pt-1"><i class="fab fa-instagram"></i></a> | 
           <a href="https://twitter.com/?lang=en" class="text-white mt-1"><i class="fab fa-twitter-square" aria-hidden="true"></i></a>
        </div>
       </div>
    </div>
    </div>

<nav class="navbar navbar-expand-lg bg-white border-bottom border-primary  ">
   <div class="container">
       <a class="navbar-brand text-primary font-weight-bold" href="index.php"><h3 class="m-0"><i class="fas fa-users"></i> MPS</h3></a>
    <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon  text-primary"><i class="fas fa-bars"></i></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link text-primary" href="index.php"><i class="fa fa-home"></i> Home </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-primary" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="far fa-list-alt"></i> Categories
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                   <?php
                  $query = "SELECT * FROM categories ORDER BY category_id DESC";
                  $run = mysqli_query($con,$query);
                  if(mysqli_num_rows($run) > 0){
                      while($row = mysqli_fetch_array($run)){
                          $category = ucfirst($row['category']);
                          $id = $row['category_id'];
                          echo "<a class='dropdown-item' href='index.php?cat=".$id."'>$category</a>";
                      }
                  }
                  else{
                      echo "<a href='#'>No Categories Yet</a>";
                  }
                  ?>
                    
                </div>
            </li>
             
            <li class="nav-item">
                <a class="nav-link text-primary" href="contactus.php"><i class="fas fa-mobile-alt"></i> Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-primary" href="about.php" ><i class="far fa-address-card"></i> About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-primary" href="help.php" ><i class="far fa-address-card"></i> Help</a>
            </li>
            <?php
                  if($session_role == 'admin' || $session_role == 'user') {
                  ?>
            
            
             <li class="nav-item dropdown ">
              <a class="nav-link pr-0 py-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center ">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image" src="assets/images/<?php echo ($session_image);?>" class="img_rounded rounded-circle" style=" height:40px"; width="40px">
                  </span>
                  
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right w-md-50 arrow mt-2 shadow dd-w">
                <div class="dropdown-header noti-title text-center bb">
                     <img alt="Image" src="assets/images/<?php echo ($session_image);?>" class="dd-img img_rounded rounded-circle border " style=" height:100px"; width="100px">
                     
                     <?php echo ucfirst($session_username);?><br>
                     <?php echo ucfirst($session_email);?>                     
                  <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
        
                <?php
                  if($session_role == 'admin'){
                  ?>
                <?php }?>
                
                <a href="admin/index.php" class="dropdown-item">
                  <i class="fas fa-tachometer-alt text-primary"></i>
                  <span>Dashboard</span>
                </a>
                <a href="admin/add_post.php" class="dropdown-item ">
                  <i class="fas fa-plus-square text-primary"></i>
                  <span>Add Post</span>
                </a>
                <a href="admin/reset_password.php" class="dropdown-item">
                  <i class="fa fa-edit text-primary"></i>
                  <span>Change Password</span>
                </a>
                <!--<div class="dropdown-divider"></div>-->
                <a href="admin/logout.php" class="dropdown-item text-danger">
                  <i class="fas fa-power-off "></i>
                  <span class="text-dark">Logout</span>
                </a>
              </div>
            </li>
            <?php }?>
                  <?php
                  if($session_role == '') {
                  ?>
            <li class="nav-item">
                <a class="nav-link text-primary" href="admin/login.php" ><i class="fas fa-sign-in-alt"></i> Login </a>
            </li>
            <?php }?>
        </ul>
    </div>
    </div>
    
</nav>
</div>

 


                
            
    