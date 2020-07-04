<?php
$session_role = $_SESSION['role'];
$session_email = $_SESSION['email'];
?>

<!----------------- Comments Admin Panel PHP Starts ------------------>
<?php

$get_comment_1 = "SELECT * FROM comments";
$get_comment_run_1 = mysqli_query($con, $get_comment_1);
$num_of_rows_1 = mysqli_num_rows($get_comment_run_1);

$get_comment_2 = "SELECT * FROM comments WHERE status = 'send'";
$get_comment_run_2 = mysqli_query($con, $get_comment_2);
$num_of_rows1_2 = mysqli_num_rows($get_comment_run_2);

$get_comment_3 = "SELECT * FROM comments WHERE status = 'receive'";
$get_comment_run_3 = mysqli_query($con, $get_comment_3);
$num_of_rows2_3 = mysqli_num_rows($get_comment_run_3);
?>

<!----------------- Comments Admin Panel PHP End ------------------>

<!----------------- Comments User Panel PHP Starts ------------------>
<?php

$session_role1 = $_SESSION['role'];

$get_comment = "SELECT * FROM comments WHERE email = '$session_email'";
$get_comment_run = mysqli_query($con, $get_comment);
$num_of_rows = mysqli_num_rows($get_comment_run);

$get_comment = "SELECT * FROM comments WHERE status = 'send' and email = '$session_email'";
$get_comment_run = mysqli_query($con, $get_comment);
$num_of_rows1 = mysqli_num_rows($get_comment_run);

$get_comment = "SELECT * FROM comments WHERE status = 'receive' and email = '$session_email'";
$get_comment_run = mysqli_query($con, $get_comment);
$num_of_rows2 = mysqli_num_rows($get_comment_run);
?>

<!----------------- Comments User Panel PHP End ------------------>

<!----------------- Posts Admin Panel PHP Starts ------------------>

<?php

$get_post_1 = "SELECT * FROM posts";
$get_post_run_1 = mysqli_query($con, $get_post_1);
$num_of_rows3_1 = mysqli_num_rows($get_post_run_1);

$get_post_2 = "SELECT * FROM posts WHERE status = 'publish'";
$get_post_run_2 = mysqli_query($con, $get_post_2);
$num_of_rows4_2 = mysqli_num_rows($get_post_run_2);

$get_post_3 = "SELECT * FROM posts WHERE status = 'draft'";
$get_post_run_3 = mysqli_query($con, $get_post_3);
$num_of_rows5_3 = mysqli_num_rows($get_post_run_3);
?>

<!----------------- Posts Admin Panel PHP End ------------------>


<!----------------- Posts User Panel PHP Starts ------------------>

<?php
$session_role2 = $_SESSION['role'];

$get_post = "SELECT * FROM posts WHERE user = '$session_email'";
$get_post_run = mysqli_query($con, $get_post);
$num_of_rows3 = mysqli_num_rows($get_post_run);

$get_post = "SELECT * FROM posts WHERE status = 'publish' and user = '$session_email'";
$get_post_run = mysqli_query($con, $get_post);
$num_of_rows4 = mysqli_num_rows($get_post_run);

$get_post = "SELECT * FROM posts WHERE status = 'draft' and user = '$session_email'";
$get_post_run = mysqli_query($con, $get_post);
$num_of_rows5 = mysqli_num_rows($get_post_run);
?>

<!-- --------------- Posts User Panel PHP End ------------------>


<div class="w-100 "  >
<ul class="list-group sidenav" id="mySidenav">
   
    <li class="list-group-item list-group-item-action active">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="index.php" class="text-white"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    </li>
                <!----------------- Posts Starts ------------------>
                    
                      <li class="list-group-item list-group-item-action pl-0 pr-0 pb-0 ">            
                        <a class="pl-4 pb-2 d-block" href="#" onclick="myAccFunc()" >
                            <i class="fas fa-mail-bulk"></i> Posts  <i class="fa fa-caret-down float-right pr-4"></i>
                        </a>         
            <div class="w3-hide" id="demoAcc" >
                      <a href="posts.php" class=" w3-bar-item list-group-item list-group-item-action text-primary border-left-0 border-right-0 rounded-0 pl-5">
                          
                         <i class="fas fa-mail-bulk"></i>  Posts 
                          
                           <?php
                          if($num_of_rows3_1 > 0){
                              if($session_role == 'admin'){
                              echo "<span class='badge badge-primary badge-pill'>$num_of_rows5_3</span>";
                          }
                              elseif($num_of_rows3 > 0){
                                    if($session_role == 'user'){
                                    echo "<span class='badge badge-primary badge-pill'>$num_of_rows5</span>";}
                              }
                              }
                          ?> 
                      </a>
                      <a href="my_posts.php" class="w3-bar-item list-group-item list-group-item-action text-primary border-left-0 border-right-0 rounded-0 pl-5">
                          
                         <i class="fas fa-mail-bulk"></i> All Posts 
                          
                           <?php
                          if($num_of_rows3_1 > 0){
                              if($session_role == 'admin'){
                              echo "<span class='badge badge-primary badge-pill'>$num_of_rows3_1</span>";
                          }
                              elseif($num_of_rows3 > 0){
                                    if($session_role == 'user'){
                                    echo "<span class='badge badge-primary badge-pill'>$num_of_rows3</span>";}
                              }
                              }
                          ?> 
                      </a>
                      
                      <a href="pending_posts.php" class="w3-bar-item list-group-item list-group-item-action text-primary border-left-0 border-right-0 rounded-0 pl-5">
                          
                         <i class="fab fa-usps"></i> New Posts 
                          
                           <?php
                          if($num_of_rows5_3 > 0){
                              if($session_role == 'admin'){
                              echo "<span class='badge badge-primary badge-pill'>$num_of_rows5_3</span>";
                          }
                              elseif($num_of_rows5 > 0){
                                    if($session_role == 'user'){
                                    echo "<span class='badge badge-primary badge-pill'>$num_of_rows5</span>";}
                              }
                              }
                          ?> 
                      </a>
                      
                      <a href="approved_posts.php" class="w3-bar-item list-group-item list-group-item-action text-primary border-left-0 border-right-0 border-bottom-0 rounded-0 pl-5">
                          
                         <i class="fas fa-vote-yea"></i> Approved Posts 
                          
                           <?php
                          if($num_of_rows4_2 > 0){
                              if($session_role == 'admin'){
                              echo "<span class='badge badge-primary badge-pill'>$num_of_rows4_2</span>";
                          }
                              elseif($num_of_rows4 > 0){
                                    if($session_role == 'user'){
                                    echo "<span class='badge badge-primary badge-pill'>$num_of_rows4</span>";}
                              }
                              }
                          ?> 
                      </a>
            </div>
                      
       </li>
                      
                      <!----------------- Posts End ------------------>
                      
                      
                    <!----------------- Comments Starts ------------------>
    
                    <a href="comments.php" class="list-group-item">
                          
                         <i class="far fa-comment-dots"></i> Comments 
                          
                           <?php
                          if($num_of_rows2_3 > 0){
                              if($session_role == 'admin'){
                              echo "<span class='badge badge-primary badge-pill'>$num_of_rows2_3</span>";
                          }
                              elseif($session_role == 'user'){
                              echo "<span class='badge badge-primary badge-pill'>$num_of_rows2</span>";
                                }
                              }
                          ?> 
                      </a>
                      
                      <!--<a href="sent_comments.php" class="list-group-item">
                          
                         <i class="far fa-comment-dots"></i> Sent Comments 
                          
                          <?php/*
                          if($num_of_rows1_2 > 0){
                              if($session_role == 'admin'){
                              echo "<span class='badge badge-primary badge-pill'>$num_of_rows1_2</span>";
                          }
                              elseif($session_role == 'user'){
                              echo "<span class='badge badge-primary badge-pill'>$num_of_rows1</span>";
                                }
                          }*/
                          ?> 
                      </a>
                      
                       <a href="receive_comments.php" class="list-group-item">
                          
                         <i class="far fa-comment-dots"></i> Receive Comments 
                          
                           <?php/*
                          if($num_of_rows2_3 > 0){
                              if($session_role == 'admin'){
                              echo "<span class='badge badge-primary badge-pill'>$num_of_rows2_3</span>";
                          }
                              elseif($session_role == 'user'){
                              echo "<span class='badge badge-primary badge-pill'>$num_of_rows2</span>";
                                }
                          }*/
                          ?> 
                      </a>-->
    
                        <!----------------- Comments End ------------------>
                        
                     <?php
                        if($session_role1 == 'admin'){
                            
                        
                        ?>
                        
                        <!----------------- Categories Starts ------------------>
                      
    <li class="list-group-item list-group-item-action ">
        <a href="categories.php"><i class="fa fa-folder-open"></i> Categories  </a> 
    </li>
    
                         <!----------------- Categories End ------------------>
                         
                        <!----------------- Users Starts ------------------>
    
    <li class="list-group-item list-group-item-action">
        <a href="users.php"><i class="fa fa-user"></i> Users</a>
        
    </li>
    
                        <!----------------- Users End ------------------>
</ul>
               

                <?php }?>
                
</div>

<script>
function myAccFunc() {
  var x = document.getElementById("demoAcc");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-green";
  } else { 
    x.className = x.className.replace(" w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-green", "");
  }
}

function myDropFunc() {
  var x = document.getElementById("demoDrop");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-green";
  } else { 
    x.className = x.className.replace(" w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-green", "");
  }
}
</script>



