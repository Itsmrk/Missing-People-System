<?php include "header.php"; ?> 
<?php include "menu.php"; ?> 
<?php
    if(!isset($_SESSION['email'])){
    header('Location: login.php');
    }
?>

<div class="container-fluid w-100 float-left position-relative <h-100xx></h-100xx>">
    <div class="row">
        <div class="col-md-3">
            <?php include "side_menu.php"; ?>   
        </div>
        <div class="col-md-9">
            <h1 class="text-primary pt-4">
                <i class="fab fa-medium"></i> Media <small>Add Or View Media Files</small>
            </h1>
            <hr>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard / </a></li>
                    <li class="active pl-1"><i class="fab fa-medium"></i> Media </li>
                </ol>
            </nav>
            
                <?php
                    if(isset($_POST['submit'])){
                        if(count($_FILES['media']['name']) > 0){
                            for($i = 0; $i < count($_FILES['media']['name']); $i++){
                                $image = $_FILES['media']['name'][$i];
                                $tmp_name = $_FILES['media']['tmp_name'][$i];
                                
                                $query = "INSERT INTO media (image) VALUES ('$image')";
                                if(mysqli_query($con, $query)){
                                    $path = "media/$image";
                                    if(move_uploaded_file($tmp_name, $path)){
                                        copy($path, "../$path");
                                    }
                                }
                                                          
                            }
                        }
                    }
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-4 col-xs-8">
                                <input type="file" name="media[]" required multiple>
                            </div>
                            <div class="col-sm-4 col-xs-4">
                                <input type="submit" name="submit" class="btn btn-primary btn-sm" value="Add Media">
                            </div>
                        </div>
                    </form><hr>
                    
                    <div class="row">
                       <?php
                        $get_query = "SELECT * FROM media ORDER BY id DESC";
                        $get_run = mysqli_query($con, $get_query);
                        if(mysqli_num_rows($get_run) > 0){
                            
                            while($get_row = mysqli_fetch_array($get_run)){
                                $get_image = $get_row['image'];
                            
                        ?>
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 thumb">
                            <a href="media/<?php echo $get_image;?>" class="thumbnail">
                                <img src="media/<?php echo $get_image;?>" width="100%" alt="">
                            </a>
                        </div>
                        <?php
                            }
                        }
                        else{
                            echo "<center><h2>No Media Files Available</h2></center>";
                        }
                        ?>
                    </div>
                  
         </div>
    </div>
</div>

                   



<?php include "footer.php"; ?> 