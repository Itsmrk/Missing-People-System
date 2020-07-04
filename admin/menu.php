 <?php
$session_role2 = $_SESSION['role'];
$session_email2 = $_SESSION['email'];

$session_image2 = $_SESSION['image'];
?>
 

 <div class="w-100 float-left h-63">
  <nav class="navbar navbar-expand-lg  bg-primary fixed-top ">
   <div class="container-fluid">
       <a class="navbar-brand text-white font-weight-bold" href="index.php"><h3 class="m-0"><i class="fas fa-users"></i> MPS</h3></a>
    
    
            <!--<div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php"></a>
            </div>-->

    <div class="" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown ">
              <a class="nav-link pr-0 py-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center ">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image" src="assets/images/<?php echo ($session_image2);?>" class="img_rounded rounded-circle"style=" height:40px ; width:40px;">
                  </span>
                  
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right w-md-50 arrow mt-2 position-absolute">
                <div class="dropdown-header noti-title text-center bb ">
                     <img alt="Image" src="assets/images/<?php echo ($session_image2);?>" class="img_rounded rounded-circle border"style=" height:100px ; width:100px;">
                     <br>
                     <?php echo ucfirst($session_role2);?><br>
                     <?php echo ucfirst($session_email2);?>                     
                  <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                <a href="profile.php" class="dropdown-item">
                  <i class="fa fa-user"></i>
                  <span>My profile</span>
                </a>
                
                <?php
                  if($session_role2 == 'admin'){
                  ?>
            
            
                <?php }?>
                
                <a href="add_post.php" class="dropdown-item">
                  <i class="fas fa-plus-square"></i>
                  <span>Add Post</span>
                </a>
                <a href="reset_password.php" class="dropdown-item">
                  <i class="fa fa-edit"></i>
                  <span>Change Password</span>
                </a>
                <a href="../index.php" class="dropdown-item">
                  <i class="fas fa-eye"></i>
                  <span>View Site</span>
                </a>
                <!--<div class="dropdown-divider"></div>-->
                <a href="logout.php" class="dropdown-item text-danger">
                  <i class="fas fa-power-off"></i>
                  <span class="text-dark">Logout</span>
                </a>
              </div>
            </li>
              
          </ul>
    </div>
    </div>
</nav>
</div>