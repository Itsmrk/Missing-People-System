<?php include "header.php"; ?> 
<?php include "menu.php"; ?> 

<?php
    if(!isset($_SESSION['email'])){
    header('Location: login.php');
    }
    else if(isset($_SESSION['email']) && ($_SESSION['role'] == 'user')){
    header('Location: index.php');
    }
?>

<?php
    if(isset($_GET['del'])){
        $del_id = $_GET['del'];
        $del_query = "DELETE FROM `users` WHERE `users`.`user_id` = $del_id";
        
        if(isset($_SESSION['email']) && $_SESSION['role'] == 'admin'){
            if(mysqli_query($con, $del_query)){
            $msg = "User Has Been Deleted Successfully";
        }
        else{
            $error = "User Has Not Been Deleted Successfully";
        }
        }
    }
    
    if(isset($_POST['checkboxes'])){
        
        foreach($_POST['checkboxes'] as $id){
            
            $bulk_option = $_POST['bulk-options'];
            
            if($bulk_option == 'delete'){
                $bulk_del_query = "DELETE FROM `users` WHERE `users`.`user_id` = $id";
                mysqli_query($con, $bulk_del_query);
            }
            else if($bulk_option == 'user'){
                $bulk_user_query = "UPDATE `users` SET `role` = 'user' WHERE `users`.`user_id` = $id";
                mysqli_query($con, $bulk_user_query);
            }
            else if($bulk_option == 'admin'){
                $bulk_admin_query = "UPDATE `users` SET `role` = 'admin' WHERE `users`.`user_id` = $id";
                mysqli_query($con, $bulk_admin_query);
            }
        }
    }
?>

<div class="container-fluid w-100 float-left position-relative ">
    <div class="row">
        <div class="col-md-3">
            <?php include "side_menu.php"; ?>   
        </div>
        <div class="col-md-9">
            
            
           
            <h1 class="text-primary pt-4 h1-s">
                <i class="fa fa-users"></i> Users: <small class="text-dark"> View All Users</small>
            </h1>
            <hr>
            <ol class="breadcrumb bc-s">
                <li><a href="index.php" class="pr-1"><i class="fa fa-tachometer"></i> Dashboard / </a></li>
              <li class="active pl-1"><i class="fa fa-users"></i> Users</li>
            </ol>
            
            
               <?php
                    $query = "SELECT * FROM users ORDER BY user_id DESC";
                    $run = mysqli_query($con, $query);
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
                                        <option value="user">Change to User</option>
                                        <option value="admin">Change to Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-8">
                                <input type="submit" class="btn btn-success" value="Apply">
                                <!--<a href="add_user.php" class="btn btn-primary">Add New</a>-->
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
                                <th>Sr #</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Contact No.</th>
                                <th>Image</th>
                                <th>Role</th>
                                <th>View User</th>
                                <th>Edit</th>
                                <th>Del</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                                while($row = mysqli_fetch_array($run)){
                                    $id = $row['user_id'];
                                    $row['cdate'];
                                    $users_date = date('d-m-Y', strtotime($row['cdate']));
                                    $first_name = ucfirst($row['first_name']);
                                    $last_name = ucfirst($row['last_name']);
                                    $username = $row['username'];
                                    $email = $row['email'];
                                    $contact_no = $row['contact_no'];
                                    $image = $row['image'];
                                    $role = $row['role'];
                                
                            ?>
                            <tr>
                               <td><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id;?>"></td>
                                <td><?php echo $id ?></td>
                                <td><?php if($users_date!='' && $users_date!='01-01-1970') {echo $users_date;} else {echo "-";}?></td>
                                <td><?php echo "$first_name $last_name"; ?></td>
                                <td><?php echo $username ?></td>
                                <td><?php echo $email ?></td>
                                <td><?php echo $contact_no ?></td>
                                <td><img src="assets/images/<?php echo $image ?>"width="30px"></td>
                                <!--<td>***********</td>-->
                                <td><?php echo ucfirst($role); ?></td>
                                <td><a href="view_user.php?view_id=<?php echo $id ?>"><i class="fas fa-eye"></i></a></td>
                                <td><a href="edit_user.php?edit=<?php echo $id ?>"><i class="fa fa-edit"></i></a></td>
                                <td><a href="users.php?del=<?php echo $id ?>"><i class="fa fa-trash-alt"></i></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    
                <?php
                    }
                    else{
                        echo "<center><h2>No User Available Now</h2></center>";
                    }
                ?>
                </form>
            
        </div><!--  .col-md-9/ -->  
    </div>
</div>

       

<?php include "footer.php"; ?> 