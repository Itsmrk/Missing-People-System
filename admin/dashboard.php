<?php 
$session_role = $_SESSION['role'];
$session_email = $_SESSION['email'];
//include "header.php";
if(!isset($_SESSION['email'])){
    header('Location: login.php');
}

//<!----------------- Comments Admin Panel PHP Starts ------------------>

$comment_tag_query = "SELECT * FROM comments WHERE status = 'send'";
$comment_tag_query1 = "SELECT * FROM comments WHERE status = 'receive'";

$com_tag_run = mysqli_query($con, $comment_tag_query);
$com_tag_run1 = mysqli_query($con, $comment_tag_query1);

$com_rows = mysqli_num_rows($com_tag_run);
$com_rows1 = mysqli_num_rows($com_tag_run1);


//<!----------------- Comments Admin Panel PHP End ------------------>

//<!----------------- Comments User Panel PHP Starts ------------------>

$comment_tag_query_1 = "SELECT * FROM comments WHERE status = 'send' and email = '$session_email'";
$comment_tag_query1_1 = "SELECT * FROM comments WHERE status = 'receive' and email = '$session_email'";

$com_tag_run_1 = mysqli_query($con, $comment_tag_query_1);
$com_tag_run1_1 = mysqli_query($con, $comment_tag_query1_1);

$com_rows_1 = mysqli_num_rows($com_tag_run_1);
$com_rows1_1 = mysqli_num_rows($com_tag_run1_1);


//<!----------------- Comments User Panel PHP End ------------------>


//<!----------------- Posts Admin Panel PHP Starts ------------------>

$posts_tag_query2 = "SELECT * FROM posts";
$posts_tag_query = "SELECT * FROM posts  WHERE status = 'draft'";
$posts_tag_query1 = "SELECT * FROM posts  WHERE status = 'publish'";

$post_tag_run2 = mysqli_query($con, $posts_tag_query2);
$post_tag_run = mysqli_query($con, $posts_tag_query);
$post_tag_run1 = mysqli_query($con, $posts_tag_query1);

$post_rows2 = mysqli_num_rows($post_tag_run2);
$post_rows = mysqli_num_rows($post_tag_run);
$post_rows1 = mysqli_num_rows($post_tag_run1);


//<!----------------- Posts Admin Panel PHP End ------------------>

//<!----------------- Posts User Panel PHP Starts ------------------>

$posts_tag_query1_1_1 = "SELECT * FROM posts  WHERE user = '$session_email'";
$posts_tag_query_1 = "SELECT * FROM posts  WHERE status = 'draft' and user = '$session_email'";
$posts_tag_query1_1 = "SELECT * FROM posts  WHERE status = 'publish' and user = '$session_email'";

$post_tag_run1_1_1 = mysqli_query($con, $posts_tag_query1_1_1);
$post_tag_run_1 = mysqli_query($con, $posts_tag_query_1);
$post_tag_run1_1 = mysqli_query($con, $posts_tag_query1_1);

$post_rows1_1_1 = mysqli_num_rows($post_tag_run1_1_1);
$post_rows_1 = mysqli_num_rows($post_tag_run_1);
$post_rows1_1 = mysqli_num_rows($post_tag_run1_1);


//<!----------------- Posts User Panel PHP End ------------------>

//<!----------------- Categories Admin Panel PHP Starts ------------------>

$category_tag_query = "SELECT * FROM categories";

$cat_tag_run = mysqli_query($con, $category_tag_query);

$cat_rows = mysqli_num_rows($cat_tag_run);

//<!----------------- Categories Admin Panel PHP End ------------------>

//<!----------------- Users Admin Panel PHP Starts ------------------>

$users_tag_query = "SELECT * FROM users";

$user_tag_run = mysqli_query($con, $users_tag_query);

$user_rows = mysqli_num_rows($user_tag_run);

//<!----------------- Users Admin Panel PHP End ------------------>

?>


<h1 class="text-primary h1-s pt-4">
    <i class="fas fa-tachometer-alt"></i> Dashboard: <small class="text-dark">User Dashboard</small>
</h1>
<hr>
<nav aria-label="breadcrumb" class="bc-s">
  <ol class="breadcrumb m-0">
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-tachometer-alt"></i> Dashboard</li>
  </ol>
</nav>


<div class="row tag-boxes">
  <?php if($session_role == 'admin'){
   ?>
   
    <!----------------- Posts Starts ------------------>
    
    <div class="col-12 col-md-6 col-lg-4 mt-4 col-xl-3">
        <div class="border border-danger rounded">
            <div class="container-fluid bg-danger text-white py-3">
                <div class="row">
                    <div class="col-sm-3 col-3 ">
                        <i class="fa fa-file-alt fa-3x"></i>
                    </div>
                    <div class="col-sm-9 col-9">
                        <div class="text-right h2 font-weight-normal">Now</div>
                        <div class="text-right font-weight-normal">Add Post</div>
                    </div>
                </div>
            </div>
            <a href="add_post.php" class="d-inline d-block px-3 py-2 text-danger">
                <div class="panel-footer">
                    <span class="float-left">Add New Post</span>
                    <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    
    <div class="col-6 col-md-6 col-lg-4 mt-4 col-xl-3">
        <div class="border border-danger rounded">
            <div class="container-fluid bg-danger text-white py-3">
                <div class="row">
                    <div class="col-sm-3 col-3">
                        <i class="fa fa-file-alt fa-3x"></i>
                    </div>
                    <div class="col-sm-9 col-9">
                        <div class="text-right h2 font-weight-normal"><?php echo $post_rows2;?></div>
                        <div class="text-right font-weight-normal">All Posts</div>
                    </div>
                </div>
            </div>
            <a href="my_posts.php" class="d-inline d-block px-3 py-2 text-danger">
                <div class="panel-footer">
                    <span class="float-left">View All Posts</span>
                    <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    
    <div class="col-6 col-md-6 col-lg-4 mt-4 col-xl-3">
        <div class="border border-danger rounded">
            <div class="container-fluid bg-danger text-white py-3">
                <div class="row">
                    <div class="col-sm-3 col-3">
                        <i class="fa fa-file-alt fa-3x"></i>
                    </div>
                    <div class="col-sm-9 col-9">
                        <div class="text-right h2 font-weight-normal"><?php echo $post_rows;?></div>
                        <div class="text-right font-weight-normal">New Posts</div>
                    </div>
                </div>
            </div>
            <a href="pending_posts.php" class="d-inline d-block px-3 py-2 text-danger">
                <div class="panel-footer">
                    <span class="float-left">View All New Posts</span>
                    <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    
    <div class="col-6 col-md-6 col-lg-4 mt-4 col-xl-3">
        <div class="border border-danger rounded">
            <div class="container-fluid bg-danger text-white py-3">
                <div class="row">
                    <div class="col-sm-3 col-3">
                        <i class="fa fa-file-alt fa-3x"></i>
                    </div>
                    <div class="col-sm-9 col-9">
                        <div class="text-right h2 font-weight-normal"><?php echo $post_rows1;?></div>
                        <div class="text-right font-weight-normal">Approved Posts</div>
                    </div>
                </div>
            </div>
            <a href="approved_posts.php" class="d-inline d-block px-3 py-2 text-danger">
                <div class="panel-footer">
                    <span class="float-left">View All Approved Posts</span>
                    <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    
    <!----------------- Posts End ------------------>
   
   <!----------------- Comments Starts ------------------>
    <div class="col-6 col-md-6 col-lg-4 mt-4 col-xl-3 ">
        <div class="border border-primary rounded">
            <div class="container-fluid bg-primary text-white py-3">
                <div class="row">
                    <div class="col-sm-3 col-3">
                        <i class="fa fa-comments fa-3x"></i>
                    </div>
                    <div class="col-sm-9 col-9">
                        <div class="text-right h2 font-weight-normal"><?php echo $com_rows;?></div>
                        <div class="text-right font-weight-normal">Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php" class="d-inline d-block px-3 py-2">
                <div class="panel-footer">
                    <span class="float-left">View All Comments</span>
                    <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    
    
    <!----------------- Comments End ------------------>
    
    
    <!----------------- Users Starts ------------------>
    
    <div class="col-6 col-md-6 col-lg-4 mt-4 col-xl-3">
        <div class="border border-warning rounded">
            <div class="container-fluid bg-warning text-white py-3">
                <div class="row">
                    <div class="col-sm-3 col-3">
                        <i class="fa fa-users fa-3x"></i>
                    </div>
                    <div class="col-sm-9 col-9">
                        <div class="text-right h2 font-weight-normal"><?php echo $user_rows;?></div>
                        <div class="text-right font-weight-normal">All Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php" class="d-inline d-block px-3 py-2 text-warning">
                <div class="panel-footer">
                    <span class="float-left">View All Users</span>
                    <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    
    <!----------------- Users End ------------------>
    
    <!----------------- Categories Starts ------------------>
    
    <div class="col-6 col-md-6 col-lg-4 mt-4 col-xl-3">
                            <div class="border border-success rounded">
                                <div class="container-fluid bg-success text-white py-3">
                                    <div class="row">
                                        <div class="col-sm-3 col-3">
                                            <i class="fa fa-folder-open fa-3x"></i>
                                        </div>
                                        <div class="col-sm-9 col-9">
                                            <div class="text-right h2 font-weight-normal"><?php echo $cat_rows;?></div>
                                            <div class="text-right font-weight-normal">All Categories</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="categories.php" class="d-inline d-block px-3 py-2 text-success">
                                    <div class="panel-footer">
                                        <span class="float-left">View All Categories</span>
                                        <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
    </div>
       
    <!----------------- Categories End ------------------>
        
 <?php   
}
      else{
          
   ?>  
   
    <!----------------- Comments User Dashboaed Starts ------------------>    
         
    <div class="col-6 col-md-6 col-lg-4 mt-4 col-xl-3">
        <div class="border border-primary rounded">
            <div class="container-fluid bg-primary text-white py-3">
                <div class="row">
                    <div class="col-sm-3 ">
                        <i class="fa fa-comments fa-3x"></i>
                    </div>
                    <div class="col-sm-9">
                        <div class="text-right h2 font-weight-normal"><?php echo $com_rows_1;?></div>
                        <div class="text-right font-weight-normal">Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php" class="d-inline d-block px-3 py-2">
                <div class="panel-footer">
                    <span class="float-left">View All Comments</span>
                    <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <!--
    <div class="col-6 col-md-6 col-lg-4 mt-4 col-xl-3">
        <div class="border border-primary rounded">
            <div class="container-fluid bg-primary text-white py-3">
                <div class="row">
                    <div class="col-sm-3 ">
                        <i class="fa fa-comments fa-3x"></i>
                    </div>
                    <div class="col-sm-9">
                        <div class="text-right h2 font-weight-normal"><?php// echo $com_rows1_1;?></div>
                        <div class="text-right font-weight-normal">Receive Comments</div>
                    </div>
                </div>
            </div>
            <a href="receive_comments.php" class="d-inline d-block px-3 py-2">
                <div class="panel-footer">
                    <span class="float-left">View All Comments</span>
                    <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>-->
    
    <!----------------- Comments User Dashboaed End ------------------>
    
    <!----------------- Posts User Dashboaed Starts ------------------>
     <div class="col-6 col-md-6 col-lg-4 mt-4 col-xl-3">
        <div class="border border-danger rounded">
            <div class="container-fluid bg-danger text-white py-3">
                <div class="row">
                    <div class="col-sm-3 ">
                        <i class="fa fa-file-alt fa-3x"></i>
                    </div>
                    <div class="col-sm-9">
                        <div class="text-right h2 font-weight-normal">Now</div>
                        <div class="text-right font-weight-normal">Add Post</div>
                    </div>
                </div>
            </div>
            <a href="add_post.php" class="d-inline d-block px-3 py-2 text-danger">
                <div class="panel-footer">
                    <span class="float-left">Add New Post</span>
                    <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    
    <div class="col-6 col-md-6 col-lg-4 mt-4 col-xl-3">
        <div class="border border-danger rounded">
            <div class="container-fluid bg-danger text-white py-3">
                <div class="row">
                    <div class="col-sm-3 ">
                        <i class="fa fa-file-alt fa-3x"></i>
                    </div>
                    <div class="col-sm-9">
                        <div class="text-right h2 font-weight-normal"><?php echo $post_rows1_1_1;?></div>
                        <div class="text-right font-weight-normal">All Posts</div>
                    </div>
                </div>
            </div>
            <a href="my_posts.php" class="d-inline d-block px-3 py-2 text-danger">
                <div class="panel-footer">
                    <span class="float-left">View All Posts</span>
                    <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    
    <div class="col-6 col-md-6 col-lg-4 mt-4 col-xl-3">
        <div class="border border-danger rounded">
            <div class="container-fluid bg-danger text-white py-3">
                <div class="row">
                    <div class="col-sm-3 ">
                        <i class="fa fa-file-alt fa-3x"></i>
                    </div>
                    <div class="col-sm-9">
                        <div class="text-right h2 font-weight-normal"><?php echo $post_rows_1;?></div>
                        <div class="text-right font-weight-normal">New Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php" class="d-inline d-block px-3 py-2 text-danger">
                <div class="panel-footer">
                    <span class="float-left">View All New Posts</span>
                    <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    
    <div class="col-6 col-md-6 col-lg-4 mt-4 col-xl-3">
        <div class="border border-danger rounded">
            <div class="container-fluid bg-danger text-white py-3">
                <div class="row">
                    <div class="col-sm-3 ">
                        <i class="fa fa-file-alt fa-3x"></i>
                    </div>
                    <div class="col-sm-9">
                        <div class="text-right h2 font-weight-normal"><?php echo $post_rows1_1;?></div>
                        <div class="text-right font-weight-normal">Approved Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php" class="d-inline d-block px-3 py-2 text-danger">
                <div class="panel-footer">
                    <span class="float-left">View All Approved Posts</span>
                    <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    
    <!----------------- Posts User Dashboaed End ------------------>
  <?php                   
                       }                 
                        
            ?>            
</div>

<hr>
                    
                    <?php
                        if($session_role == 'admin'){
                            ?>
                    <?php

                        $get_users_query = "SELECT * FROM users ORDER BY user_id DESC LIMIT 5";
                        $get_users_run = mysqli_query($con,$get_users_query);
                        if(mysqli_num_rows($get_users_run) > 0){
                            
                    ?>

                    <h3>New Users</h3>
                    <table class="table-bordered w-100 table-hover table-striped">
                        <thead>
                            <tr>
                                <th class="d-none d-sm-none d-md-block">Sr #</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <!--<th>Role</th>-->
                            </tr>
                        </thead>
                        <tbody>
                           <?php 
                            while($get_users_row = mysqli_fetch_array($get_users_run)){
                                $users_id = $get_users_row['user_id'];
                                $get_users_row['cdate'];
                                $users_date = date('d-m-Y', strtotime($get_users_row['cdate']));
                                //$users_day = $users_date['mday'];
                                //$users_month = substr($users_date['month'],0,3);
                                //$users_year = $users_date['year'];
                                $users_firstname = $get_users_row['first_name'];
                                $users_lastname = $get_users_row['last_name'];
                                $users_fullname = "$users_firstname $users_lastname";
                                $users_username = $get_users_row['username'];
                                $users_email = $get_users_row['email'];
                               // $users_role = $get_users_row['role'];
                            
                            ?>
                            <tr>
                                <td  class="d-none d-sm-none d-md-block"><?php echo $users_id;?></td>
                                <td><?php if($users_date!='' && $users_date!='01-01-1970') {echo $users_date;} else {echo "-";}?></td>
                                <td><?php echo $users_fullname;?></td>
                                <td><?php echo ucfirst($users_username);?></td>
                                <td><?php echo ucfirst($users_email);?></td>
                                <td><?php //echo ucfirst($users_role);?></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <a href="users.php" class="btn btn-primary">View All Users</a><hr>
                    <?php } ?>


 <?php
                    $get_posts_query = "SELECT * FROM posts ORDER BY post_id DESC LIMIT 5";
                    $get_posts_run = mysqli_query($con,$get_posts_query);
                    if(mysqli_num_rows($get_posts_run) > 0){
                        
                    
                    ?>
                    <h3>New Posts</h3>
                    <table class="table-bordered w-100 table-hover table-striped">
                        <thead>
                            <tr>
                                <th class="d-none d-sm-none d-md-block">Sr #</th>
                                <th>Date</th>
                                <th>Post Title</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Category</th>
                                <th>Views</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php 
                            while($get_posts_row = mysqli_fetch_array($get_posts_run)){
                                $posts_id = $get_posts_row['post_id'];
                                $date = date('Y-m-d');
                                //$get_users_row['cdate'];
                                //$posts_users_date = date('d-m-Y', strtotime($get_users_row['cdate']));
                                //$posts_date = getdate($get_posts_row['date']);
                                //$posts_day = $posts_date['mday'];
                                //$posts_month = substr($posts_date['month'],0,3);
                                //$posts_year = $posts_date['year'];
                                $posts_title = $get_posts_row['title'];
                                $posts_age = $get_posts_row['age'];
                                $posts_gender = $get_posts_row['gender'];
                                $posts_categories = $get_posts_row['categories'];
                                $posts_views = $get_posts_row['views'];
                            
                            ?>
                            <tr>
                                <td class="d-none d-sm-none d-md-block"><?php echo $posts_id;?></td>
                                <td><?php if(isset($date)){echo date('Y-m-d', strtotime($date));}?></td>
                               <!-- <td><?php// echo "$posts_day $posts_month $posts_year";?></td>-->
                                <td><?php echo $posts_title;?></td>
                                <td><?php echo $posts_age;?></td>
                                <td><?php echo ucfirst($posts_gender);?></td>
                                <td><?php echo ucfirst($posts_categories);?></td>
                                <td><i class="fa fa-eye"></i> <?php echo $posts_views;?></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <a href="posts.php" class="btn btn-primary">View All Posts</a>
                    <?php } ?>
                    
                   <?php }?>