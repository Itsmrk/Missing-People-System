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
        $del_check_query = "SELECT * FROM posts WHERE post_id = $del_id";
        $del_check_run = mysqli_query($con, $del_check_query);
    }
    else if($_SESSION['role'] == 'user'){
        $del_check_query = "SELECT * FROM posts WHERE post_id = $del_id and user = '$session_email'";
        $del_check_run = mysqli_query($con, $del_check_query);
    }
    if(mysqli_num_rows($del_check_run) > 0){
        $del_query = "DELETE FROM `posts` WHERE `posts`.`post_id` = $del_id";
        if(mysqli_query($con, $del_query)){
            $msg = "Post Has Been Deleted Sucussfully";
        }
        else{
            $error = "Post Has Not Been Deleted Sucussfully";
        } 
    }
    else{
        header('location: index.php');
    }
}
    
    if(isset($_POST['checkboxes'])){
    
    foreach($_POST['checkboxes'] as $id){
        
        $bulk_option = $_POST['bulk-options'];
        
        if($bulk_option == 'delete'){
            $bulk_del_query = "DELETE FROM `posts` WHERE `posts`.`post_id` = $id";
            mysqli_query($con, $bulk_del_query);
        }
        else if($bulk_option == 'publish'){
            $bulk_user_query = "UPDATE `posts` SET `status` = 'publish' WHERE `posts`.`post_id` = $id";
            mysqli_query($con, $bulk_user_query);
        }
        else if($bulk_option == 'draft'){
            $bulk_admin_query = "UPDATE `posts` SET `status` = 'draft' WHERE `posts`.`post_id` = $id";
            mysqli_query($con, $bulk_admin_query);
        }
        
    }
    
}
?>

<div class="container-fluid w-100 float-left position-relative">
    <div class="row">
        <div class="col-md-3">
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
                        $query = "SELECT * FROM posts WHERE user = '$session_email' ORDER BY post_id DESC";
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
                                        <option value="publish">Publish</option>
                                        <option value="draft">Draft</option>
                                        
                                        <?php }?>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-8">
                                <input type="submit" class="btn btn-success" value="Apply">
                                <a href="add_post.php" class="btn btn-primary">Add New</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                    <?php
                        if(isset($error)){
                            echo "<span style='color:red;' class='pull_right'>$error</span>";
                        }
                        else if(isset($msg)){
                            echo "<span style='color:green;' class='pull_right'>$msg</span>";
                        }
                    ?>
                    
                    <table id="example" class="table table-bordered table-striped table-hover">
                        <thead class="bg-primary text-white">
                            <tr>
                               <th><input type="checkbox" id="selectallboxes"></th>
                                <!--<th>Sr #</th>-->
                                <th>Date</th>
                                <th>Title</th>
                                <th>User</th>
                                <th>Image</th>
                                <th>P_Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Status</th>
                                <th>View Post</th>
                                <th>Edit</th>
                                <th>Del</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while($row = mysqli_fetch_array($run)){
                               $id = $row['post_id'];
                               /* $date = getdate($row['cdate']);
                                $day = $date['mday'];
                                $month = substr($date['month'],0,3);
                                $year = $date['year'];*/
                                $day = date('d', strtotime($row['cdate']));
                                $mon_year = date('M, Y', strtotime($row['cdate']));
                                //$get_users_row['cdate'];
                                //$users_date = date('d-m-Y', strtotime($get_users_row['cdate']));
                                
                                $title = $row['title'];
                                $user = $row['user'];
                                //$user_image = $row['user_image'];
                                $image = $row['image'];
                                $person_name = $row['person_name'];
                                $age = $row['age'];
                                $gender = $row['gender'];
                                $contact_no = $row['contact_no'];
                                $categories = $row['categories'];
                                $cities = $row['cities'];
                                $states = $row['states'];
                                $countries = $row['countries'];
                                $views = $row['views'];
                                $contact_no = $row['contact_no'];
                                $address = $row['address'];
                                $missing_date = $row['missing_date'];
                                $status = $row['status'];
                                
                            ?>
                            <tr>
                               <td><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id;?>"></td>
                               <!-- <td><?php// echo $id;?></td>-->
                                <td><?php echo $day;?> <?php echo $mon_year;?></td>
                                
                                <td><?php echo ucfirst($title);?></td>
                                <td><?php echo ucfirst($user);?></td>
                                <!--<td><img src="assets/images/<?php// echo $user_image;?>" width="50px"></td>-->
                                <td><img src="assets/images/<?php echo $image;?>" width="50px"></td>
                                <td><?php echo ucfirst($person_name);?></td>
                                <td><?php echo ucfirst($age);?></td>
                                <td><?php echo ucfirst($gender);?></td>
                                <td><span style="color:<?php
                                    if($status == 'publish'){
                                        echo 'green';
                                    }
                                    else if($status == 'draft'){
                                        echo 'red';
                                    }
                                    ?>;"><?php echo ucfirst($status);?></span></td>
                                <td><a href="view_post.php?view_id=<?php echo $id;?>"><i class="fas fa-eye"></i></a></td>
                                <td><a href="edit_post.php?edit=<?php echo $id;?>"><i class="fa fa-edit"></i></a></td>
                                <td><a href="posts.php?del=<?php echo $id;?>"><i class="fa fa-times"></i></a></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    
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