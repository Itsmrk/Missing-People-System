<?php include "header.php"; ?> 
<?php include "menu.php"; ?> 

<?php
    if(!isset($_SESSION['email'])){
    header('Location: login.php');
    }
?>

<?php
    $session_role = $_SESSION['role'];
    $session_email = $_SESSION['email'];
?>

<div class="container-fluid w-100 float-left position-relative ">
    <div class="row">
        <div class="col-md-3 col-12">
            <?php include "side_menu.php"; ?>   
        </div>
        <div class="col-md-9">
            
            
           
            <h1 class="text-primary pt-4 h1-s">
                <i class="fas fa-file-alt"></i> Posts: <small class="text-dark"> View All Posts</small>
            </h1>
            <hr>
            <ol class="breadcrumb bc-s">
                <li><a href="posts.php" class="pr-1"><i class="fa fa-tachometer"></i> Dashboard / </a></li>
              <li class="active pl-1"><i class="fas fa-file-alt"></i> Posts </li>
            </ol>
            
            
               <?php
                    if($_SESSION['role'] == 'admin'){
                        $query = "SELECT * FROM posts ORDER BY post_id DESC";
                        $run = mysqli_query($con, $query);
                    }
                    else if($_SESSION['role'] == 'user'){
                        $query = "SELECT * FROM posts WHERE user = '$session_email' and status = 'publish' ORDER BY post_id DESC";
                        $run = mysqli_query($con, $query);
                    }
            
                    if(mysqli_num_rows($run) > 0){
                        
                    
                ?>
            <form action="" method="post">
               
               
                    
                    <?php
                        if(isset($error)){
                            echo "<span style='color:red;' class='pull_right'>$error</span>";
                        }
                        else if(isset($msg)){
                            echo "<span style='color:green;' class='pull_right'>$msg</span>";
                        }
                    ?>
                    
                    
                    <!-- =====================================================================================================  --->
                     <?php
                            while($row = mysqli_fetch_array($run)){
                                $id = $row['post_id'];
                                $day = date('d', strtotime($row['cdate']));
                                $mon_year = date('M, Y', strtotime($row['cdate']));
                                $image = $row['image'];
                                $person_name = $row['person_name'];
                                $cities = $row['cities'];                                
                                $missing_date = $row['missing_date'];
                            ?>
                   <div class="container">
                        <div class="row">
                           <div class="col-md-6 col-12">
                               <div class="container mb-3 border border-primary rounded pb-3">
                                <div class="row">
                                    
                                        <div class="w-100">
                                            <img class="img-fluid" src="assets/images/<?php echo $image;?>">
                                        </div>
                              
                                    <div class="col-md-4 col-4 post-title py-4 ">
                                    <h4 class="pb-2 mb-0 text-primary  border-bottom border-primary">Missing Date: <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php echo $missing_date; ?></p>  </h4>

                                    </div>
                                   <div class="col-md-4 col-4 post-title py-4 ">
                                        <h4 class="pb-2 mb-0 text-primary  border-bottom border-primary">Person Name: <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php echo  $person_name; ?></p>  </h4>

                                    </div>
                                    <div class="col-md-4 col-4 post-title py-4 ">
                                        <h4 class="pb-2 mb-0 text-primary  border-bottom border-primary">Missing From: 
                                           <p class="bg-light text-center text-uppercase text-secondary py-3 h6">
                                                <?php 
                                                    $Res_C = mysqli_query($con, "SELECT city_name from cities where city_id = ". $cities);
                                                    $Row_C = mysqli_fetch_array($Res_C); echo $Row_C[0];
                                                ?>
                                            </p>  
                                        </h4>

                                    </div>
                                    <div class="col-md-4 col-4 text-center mp-f-s">
                                        <a href="edit_post.php?edit=<?php echo $id;?>"><i class="fa fa-edit"></i> Edit Post</a>
                                    </div>
                                    <div class="col-md-4 col-4 text-center mp-f-s">
                                        <a href="view_post.php?view_id=<?php echo $id;?>"><i class="fas fa-eye"></i> View Post</a>
                                    </div>
                                    <div class="col-md-4 col-4 text-center mp-f-s">
                                        <a href="../single_post.php?post_id=<?php echo $id;?>"><i class="fas fa-eye"></i> Comments</a>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    
                    
                    
                    
                    
                    <!--  ============================================================================ -->
                    
                    
                    
                    
                    
             

 
                    
                    
                    
                    <!--  =============================================================================  --->
                    
                     <?php }?>
                     
                     
                     <!-- ==================================================  ==================================================== -->
                    
                <?php
                    }
                    else{
                        echo "<center><h2>No Post Available Now</h2></center>";
                    }
                ?>
                </form>
            
        </div><!--  .col-md-9/ -->  
    </div>
</div>

       

<?php include "footer.php"; ?> 