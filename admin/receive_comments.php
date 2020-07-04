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

    if(isset($_GET['del'])){
    $del_id = $_GET['del'];
    if($_SESSION['role'] == 'admin'){
        $del_check_query = "SELECT * FROM comments WHERE comment_id = $del_id";
        $del_check_run = mysqli_query($con, $del_check_query);
    }
    else if($_SESSION['role'] == 'user'){
        $del_check_query = "SELECT * FROM comments WHERE comment_id = $del_id and user = '$session_email'";
        $del_check_run = mysqli_query($con, $del_check_query);
    }
    if(mysqli_num_rows($del_check_run) > 0){
        $del_query = "DELETE FROM `comments` WHERE `comments`.`comment_id` = $del_id";
        if(mysqli_query($con, $del_query)){
            $msg = "Comment Has Been Deleted Sucussfully";
        }
        else{
            $error = "Comment Has Not Been Deleted Sucussfully";
        } 
    }
    else{
        header('location: index.php');
    }
}
    
    if(isset($_GET['receive'])){
    $receive_id = $_GET['receive'];
    $receive_check_query = "SELECT * FROM comments WHERE comment_id = $receive_id";
    $receive_check_run = mysqli_query($con, $receive_check_query);
    if(mysqli_num_rows($receive_check_run) > 0){
        $receive_query = "UPDATE `comments` SET `status` = 'receive' WHERE `comments`.`comment_id` = $receive_id";
        if(isset($_SESSION['email']) && $_SESSION['role'] == 'admin'){ 
            if(mysqli_query($con, $receive_query)){
                $msg = "Comment Has Been Receive";
            }
            else{
                $error = "Comment Has Not Been Receive";
            } 
         }
    }
    else{
        header('location: index.php');
    }
}

/*if(isset($_GET['unapproved'])){
    $unapproved_id = $_GET['unapproved'];
    $unapproved_check_query = "SELECT * FROM comments WHERE id = $unapproved_id";
    $unapproved_check_run = mysqli_query($con, $unapproved_check_query);
    if(mysqli_num_rows($unapproved_check_run) > 0){
        $unapproved_query = "UPDATE `comments` SET `status` = 'pending' WHERE `comments`.`id` = $unapproved_id";
       if(isset($_SESSION['email']) && $_SESSION['role'] == 'admin'){ 
            if(mysqli_query($con, $unapproved_query)){
                $msg = "Comment Has Been Unapproved";
            }
            else{
                $error = "Comment Has Not Been Unapproved";
            } 
       }
    }
    else{
        header('location: index.php');
    }
}*/

if(isset($_POST['checkboxes'])){
    
    foreach($_POST['checkboxes'] as $user_id){
        
        $bulk_option = $_POST['bulk-options'];
        
        if($bulk_option == 'delete'){
            $bulk_del_query = "DELETE FROM `comments` WHERE `comments`.`comment_id` = $user_id";
            mysqli_query($con, $bulk_del_query);
        }
        else if($bulk_option == 'receive'){
            $bulk_author_query = "UPDATE `comments` SET `status` = 'receive' WHERE `comments`.`comment_id` = $user_id";
            mysqli_query($con, $bulk_author_query);
        }/*
        else if($bulk_option == 'pending'){
            $bulk_admin_query = "UPDATE `comments` SET `status` = 'pending' WHERE `comments`.`id` = $user_id";
            mysqli_query($con, $bulk_admin_query);
        }*/
        
    }
    
}
?>

<div class="container-fluid w-100 float-left position-relative ">
    <div class="row">
        <div class="col-md-3">
            <?php include "side_menu.php"; ?>   
        </div>
        <div class="col-md-9">
            
            
           
            <h1 class="text-primary pt-4">
                <i class="fa fa-comments "></i> Receive Comments: <small class="text-dark"> View All Comments</small>
            </h1>
            <hr>
            <ol class="breadcrumb">
                <li><a href="index.php" class="pr-1"><i class="fa fa-tachometer"></i> Dashboard / </a></li>
                <li class="active pl-1"><i class="fa fa-comments"></i> View All Receive Comments</li>
            </ol>
            <?php
                    if(isset($_GET['reply'])){
                        $reply_id = $_GET['reply'];
                        $reply_check = "SELECT * FROM comments WHERE post_id = $reply_id";
                        $reply_check_run = mysqli_query($con, $reply_check);
                        if(mysqli_num_rows($reply_check_run) > 0){
                            if(isset($_POST['reply'])){
                                $comment_data = $_POST['comment'];
                                if(empty($comment_data)){
                                    $comment_error = "Must Fill This Feild";
                                }
                                else{
                                    $get_user_data = "SELECT * FROM users WHERE email = '$session_email'";
                                    $get_user_run = mysqli_query($con, $get_user_data);
                                    $get_user_row = mysqli_fetch_array($get_user_run);
                                    //$date = time();
                                    $date = date('Y-m-d');
                                    $first_name = $get_user_row['first_name'];
                                    $last_name = $get_user_row['last_name'];
                                    $full_name = "$first_name $last_name";
                                    $email = $get_user_row['email'];
                                    $image = $get_user_row['image'];
                                    
                                    $insert_comment_query = "INSERT INTO comments (cdate, name, username, post_id, email, contact_no, image, comment, status) VALUES ('$date','$full_name','$session_username','$reply_id','$email','$contact_no','$image','$comment_data','receive')";
                                    if(mysqli_query($con, $insert_comment_query)){
                                        $comment_msg = "Comment Has Been Receive";
                                        header('location: comments.php');
                                    }
                                    else{
                                        $comment_error = "Comment Has Not Been Receive";
                                    }
                                }
                            }
                        
                    ?>
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="comment">Comment:*</label>
                                    <?php
                                    if(isset($comment_error)){
                                        echo "<span class='pull-right' style='color:red;'>$comment_error</span>";
                                    }
                            else if(isset($comment_msg)){
                                        echo "<span class='pull-right' style='color:green;'>$comment_msg</span>";
                                    }
                                    ?>
                                    <textarea name="comment" id="comment" cols="30" rows="10" placeholder="Your Comment Here" class="form-control"></textarea>
                                </div>
                                <input type="submit" name="reply" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                    
                    <hr>
                    
                    
                    
                    <?php
                            
                            }
                    }
                    $query = "SELECT * FROM comments ORDER BY comment_id DESC";
                    $run = mysqli_query($con, $query);
                    if(mysqli_num_rows($run) > 0){
                    ?>
                    
                    <?php
                    if($_SESSION['role'] == 'admin'){
                        $query = "SELECT * FROM comments WHERE status = 'receive' ORDER BY comment_id DESC";
                        $run = mysqli_query($con, $query);
                    }
                    else if($_SESSION['role'] == 'user'){
                        $query = "SELECT * FROM comments WHERE status = 'receive' and email = '$session_email' ORDER BY comment_id DESC";
                        $run = mysqli_query($con, $query);
                    }
            
                    if(mysqli_num_rows($run) > 0){
                        
                    
                ?>
                    
                    
            <form action="" method="post">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select name="bulk-options" id="" class="form-control">
                                        <option value="delete">Delete</option>
                                        <?php
                                            if($session_role == 'admin'){
                                        ?>
                                        <option value="receive">Receive</option>
                                       <!-- <option value="pending">Unapproved</option>-->
                                        <?php }?>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-8">
                                <input type="submit" class="btn btn-success" value="Apply">
                            </div>
                        </div>
                    </div>
                    </div>
                    <?php
                        if(isset($error)){
                            echo "<span class='float-right text-danger'>$error</span>";
                        }
                        else if(isset($msg)){
                            echo "<span class='float-right text-success'>$msg</span>";
                        }
                    ?>
                    <table id="example" class="table table-bordered table-striped table-hover w-100">
                        <thead class="bg-primary text-white">
                            <tr>
                               <th><input type="checkbox" id="selectallboxes"></th>
                                <th>Sr #</th>
                                <th>Date</th>
                                <th>Email</th>
                                <th>Contact No:</th>
                                <th>Comment</th>
                                <th>Status</th>
                                
                                <?php
                                    if($session_role == 'admin'){
                                ?>
                                <!--<th>Receive</th>
                                <th>Unapproved</th>-->
                                <?php }?>
                                
                                <th>Reply</th>
                                
                                <th>Del</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                            while($row = mysqli_fetch_array($run)){
                                $id = $row['comment_id'];
                                $email = $row['email'];
                                $status = $row['status'];
                                $contact_no = $row['contact_no'];
                                $comment = $row['comment'];
                                $post_id = $row['post_id'];
                                $day = date('d', strtotime($row['cdate']));
                                $mon_year = date('M, Y', strtotime($row['cdate']));
                               /* $date = getdate($row['date']);
                                $day = $date['mday'];
                                $month = substr($date['month'],0,3);
                                $year = $date['year'];*/
                            ?>
                            <tr>
                               <td><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id;?>"></td>
                                <td><?php echo $id;?></td>
                                <td><?php echo $day;?> <?php echo $mon_year;?></td>
                                <td><?php echo $email;?></td>
                                <td><?php echo $contact_no;?></td>
                                <td><?php echo $comment;?></td>
                                <td><span style="color:<?php if($status == 'receive'){echo 'green';}//else if($status == 'pending'){echo 'red';}?>;"><?php echo ucfirst($status);?></span></td>
                                
                                <?php
                                    if($session_role == 'admin'){
                                ?>
                                <!--<td><a href="receive_comments.php?receive=<?php// echo $id;?>">Receive</a></td>
                                <td><a href="comments.php?unapproved=<?php// echo $id;?>">Unapproved</a></td>-->
                                
                                <?php }?>
                                
                                <td><a href="receive_comments.php?reply=<?php echo $post_id;?>"><i class="fa fa-reply"></i></a></td>
                                <td><a href="receive_comments.php?del=<?php echo $id;?>"><i class="fa fa-trash-alt"></i></a></td>
                            </tr>
                            <?php 
                            }?>
                        </tbody>
                    </table>
                    <?php
                    }
                    }
                    else{
                        echo "<center><h2>No Receiving Comments Availabe Now</h2></center>";
                    }
                    ?>
                    </form>
            
            
        </div><!--  .col-md-9/ -->  
    </div>
</div>


       

<?php include "footer.php"; ?> 