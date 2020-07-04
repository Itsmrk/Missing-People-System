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


    if(isset($_GET['edit'])){
    $edit_id = $_GET['edit'];
    if($session_role == 'admin' || $session_role == 'user'){
        $get_query = "SELECT * FROM posts WHERE post_id = $edit_id";
        $get_run = mysqli_query($con, $get_query);
    }
    /*else if($session_role == 'user'){
        
        $get_query = "SELECT * FROM posts WHERE id = $edit_id and user = '$session_role'";
        $get_run = mysqli_query($con, $get_query);
    }*/
    
    if(mysqli_num_rows($get_run) > 0){
        $get_row = mysqli_fetch_array($get_run);
        $title = $get_row['title'];
        //$post_data = $get_row['post_data'];
        //$tags = $get_row['tags'];
        $image = $get_row['image'];
        //$tmp_name = $get_row['image']['tmp_name'];
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
             <h1 class="text-primary pt-4 h1-s">
                <i class="fas fa-file-signature"></i> Edit Post: <small>Edit Post Detail</small>
            </h1>
            <hr>
            <nav aria-label="breadcrumb bc-s">
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard / </a></li>
                    <li class="active pl-1"><i class="fas fa-file-signature"></i> Edit Post </li>
                </ol>
            </nav>  
            
             <?php
                    if(isset($_POST['Update'])){
                        $date = time();
                        $up_title = mysqli_real_escape_string($con,$_POST['title']);
                       // $up_post_data = mysqli_real_escape_string($con,$_POST['post-data']);
                        $up_categories = $_POST['categories'];
                        //$up_tags = mysqli_real_escape_string($con,$_POST['tags']);
                        $up_status = $_POST['status'];
                        $up_gender = $_POST['gender'];
                        $up_countries = $_POST['countries'];
                        $up_states = $_POST['states'];
                        $up_cities = $_POST['cities'];
                        $up_image = $_FILES['image']['name'];
                        $up_tmp_name = $_FILES['image']['tmp_name'];
                        $up_person_name = $_POST['person_name'];
                        $up_age = $_POST['age'];
                        $up_contact_no = $_POST['contact_no'];
                        $up_address = $_POST['address'];
                        $up_missing_date = $_POST['missing_date'];
                     //   $views = $_POST['views'];
                        
                        if(empty($up_image)){
                            $up_image = $image;
                        }
                        
                        if(empty($up_title)){
                            $error = "All (*) Fields Are Required";
                            
                        }
                        else{
                             $update_query = "UPDATE posts SET title = '$up_title' , image = '$up_image', person_name = '$up_person_name', age = '$up_age', gender = '$up_gender', categories = '$up_categories', countries = '$up_countries', states = '$up_states', cities = '$up_cities', contact_no = '$up_contact_no', address = '$up_address', missing_date = '$up_missing_date', status = '$up_status' WHERE post_id = '$edit_id'";
                            
                            if(mysqli_query($con, $update_query)){
                                
                                $_SESSION['msg'] = "<span class='pull-right' style='color:green;'>Post Has Been Updated Successfully</span>";
                                $path = "assets/images/$up_image";
                                
                                 //header("location: edit_post.php?edit=$edit_id");
                                    if(!empty($up_image)){
                                        if(move_uploaded_file($up_tmp_name, $path)){
                                        copy($path, "../$path");
                                    }
                                
                               /* $title = "";
                                $post_data = "";
                                $tags = "";
                                $gender = "";
                                $country = "";
                                $province = "";
                                $city = "";
                                $contact_no = "";
                                //$views = "";
                                $status = "";
                                $categories = "";*/
                                
                            }
                            else{
                                $_SESSION['msg'] = "<span class='pull-right' style='color:red;'>Post Has Not Been Updated Successfully</span>";
                                    }
                                }
                        }
                    }
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="status" value="<?php echo $status; ?>" />
                       <div class="row">
                       <div class="col-md-8  ">
                         <div class="container">
                          <div class="row">
                          
                                <?php 
                                    if(isset($_SESSION['msg'])){
                                        echo $_SESSION['msg']; unset($_SESSION['msg']); $_SESSION['msg']='';
                                    }
                                ?>
                          
                          <div class="card w-100 mt-3">
                        <div class="card-header">
                          <div class="row align-items-center">
                            <div class="col-8">
                              <h3 class="mb-0"> Edit Post </h3>
                            </div>
                            <div class="col-4 text-right">
                              <input type="submit" value="Update Post" name="Update" class="btn btn-primary">
                              
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
                                            <select class="form-control" name="categories" id="categories">
                                                <?php
                                                $cat_query = "SELECT * FROM categories ORDER BY category_id DESC";
                                                $cat_run = mysqli_query($con, $cat_query);
                                                if(mysqli_num_rows($cat_run) > 0){
                                                    while($cat_row = mysqli_fetch_array($cat_run)){
                                                        $cat_name = $cat_row['category'];
                                                        echo "<option value='".$cat_name."' ".((isset($categories) and $categories == $cat_name)?"selected":"").">".ucfirst($cat_name)."</option>";
                                                        
                                                    }
                                                }
                                                else{
                                                    echo "<cetner><h6>No Category Available</h6></center>";
                                                }
                                                ?>
                                            </select>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <h6 class="heading-small text-muted mb-4">Missing Since</h6>
                                  <div class="form-group">
                                    <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Missing Date:</h6>
                                        <input name="missing_date" placeholder="mm/dd/yyyy" id="" type="date" value="<?php if(isset($missing_date)){echo $missing_date;}?>" class="form-control">
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
                                    <input type="text" name="title" placeholder="Type Post Title Here" value="<?php if(isset($title)){echo $title;}?>" class="form-control">
                                    </div>
                                </div>
                                
                                
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Person Name:</h6>
                                    <input type="text" id="person" name="person_name" class="form-control" placeholder="Enter Person Name" value="<?php if(isset($person_name)){echo $person_name;}?>">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Gender:</h6>
                                            <select class="form-control" name="gender" id="gender">
                                                <option value="male" <?php if(isset($gender) and $gender == 'male'){echo "selected";}?>>Male</option>
                                                <option value="female" <?php if(isset($gender) and $gender == 'female'){echo "selected";}?>>Female</option>
                                                <option value="others" <?php if(isset($gender) and $gender == 'others'){echo "selected";}?>>Others</option>
                                            </select>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Age:</h6>
                                    <input type="number" id="age" name="age" class="form-control" placeholder="Enter Missing Person Age" value="<?php if(isset($age)){echo $age;}?>">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <hr class="my-4">
                            <!-- Address -->
                            <h6 class="heading-small text-muted mb-4">Contact Information</h6>
                            <div class="pl-lg-4">
                              <div class="row">
                                
                                <div class="col-lg-6">
                                  <div class="form-group">
                                   <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Countries:</h6>
                                    <select class="form-control-label w-100 form-control" name="countries" id="countries">
                                        <option value="">Select Country</option>
                                        
                                            <?php 
                                                if($edit_id!=''){
                                                $cou_query = "SELECT * FROM countries where country_id=".$countries;
                                                $cou_run = mysqli_query($con, $cou_query);
                                                $cou_row = mysqli_fetch_array($cou_run);
                                                         echo "<option value='".$cou_row['country_id']."' ".((isset($countries) && $countries == $cou_row['country_id']) ? "selected":"").">".ucfirst($cou_row['country_name'])."</option>";
                                                    
                                                //Not Country ID
                                                $cou_query1 = "SELECT * FROM countries where NOT (country_id=".$countries.")";
                                                $cou_run1 = mysqli_query($con, $cou_query1);
                                                while($cou_row1 = mysqli_fetch_array($cou_run1)){
                                                         echo "<option value='".$cou_row1['country_id']."'>".ucfirst($cou_row1['country_name'])."</option>";
                                                }
                                        
                                                }
                                            ?>
                                    </select>
                                  </div>
                                </div>
                                
                                <div class="col-lg-3">
                                   <div class="form-group">
                                        <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">States:</h6>
                                            <select class="form-control-label  w-100 form-control" name="states" id="states">
                                                <option value="">Select States</option>
                                            <?php 
                                                if($edit_id!=''){
                                                $cou_query = "SELECT * FROM states where state_id=".$states;
                                                $cou_run = mysqli_query($con, $cou_query);
                                                $cou_row = mysqli_fetch_array($cou_run);
                                                         echo "<option value='".$cou_row['state_id']."' ".((isset($states) && $states == $cou_row['state_id']) ? "selected":"").">".ucfirst($cou_row['state_name'])."</option>";
                                                    
                                                //Not Country ID
                                                $cou_query1 = "SELECT * FROM states where NOT (state_id=".$states.") and country_id = '$countries'";
                                                $cou_run1 = mysqli_query($con, $cou_query1);
                                                while($cou_row1 = mysqli_fetch_array($cou_run1)){
                                                         echo "<option value='".$cou_row1['state_id']."'>".ucfirst($cou_row1['state_name'])."</option>";
                                                }
                                        
                                                }
                                            ?>  

                                            </select>
                                   </div>
                                </div>
                                
                                <div class="col-lg-3">
                                   <div class="form-group">
                                        <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Cities:</h6>
                                            <select class="form-control-label  w-100 form-control" name="cities" id="cities">
                                                <option value="">Select City</option>
                                            <?php 
                                                if($edit_id!=''){
                                                $cou_query = "SELECT * FROM cities where city_id=".$cities;
                                                $cou_run = mysqli_query($con, $cou_query);
                                                $cou_row = mysqli_fetch_array($cou_run);
                                                         echo "<option value='".$cou_row['city_id']."' ".((isset($cities) && $cities == $cou_row['city_id']) ? "selected":"").">".ucfirst($cou_row['city_name'])."</option>";
                                                    
                                                //Not Country ID
                                                $cou_query1 = "SELECT * FROM cities where NOT (city_id=".$cities.") and state_id = '$states' and country_id = '$countries'";
                                                $cou_run1 = mysqli_query($con, $cou_query1);
                                                while($cou_row1 = mysqli_fetch_array($cou_run1)){
                                                         echo "<option value='".$cou_row1['city_id']."'>".ucfirst($cou_row1['city_name'])."</option>";
                                                }
                                        
                                                }
                                            ?>
                                            </select>
                                   </div>
                                </div>
                                
                                <div class="col-lg-6">
                                  <div class="form-group">
                                     <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Contact No:</h6>
                                            <input type="text" name="contact_no" placeholder="Enter Contact No" id="contact" value="<?php if(isset($contact_no)){echo $contact_no;}?>" class="form-control">
                                  </div>
                                  
                                </div>
                                <div class="col-lg-12 text-left">
                                  <div class="form-group">
                                    <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Address:</h6>
                                    
                                    <textarea id="address" name="address" class="form-control text-left" placeholder="Enter Address">
                                        <?php if(isset($address)){echo $address;}?>
                                    </textarea>
                                  </div>
                                </div>
                                
                              </div>
                              
                            </div>
                            
                            <hr class="my-4">
                            <h6 class="heading-small text-muted mb-4">Choose Image</h6>
                            <div class="pl-lg-4">
                             <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <h6 class="pb-2 mb-0 text-primary">Choose Profile Image:</h6>
                                    <input type="file" id="image" name="image">
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                          </form>
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
               
        </div>
    </div>
</div>
       
       
       

 <!-- Ajax Code -->      

<?php include "footer.php"; ?>

<script>
    $("input").intlTelInput({
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.6/js/utils.js"
    });
</script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script>
        $('#missing_date').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>


<script>

    $(function() {

  $('#countries').bind('change', function(ev) {

     var value = $(this).val();
      
      var request = $.ajax({
          url: "ajax.php",
          type: "POST",
          data: {country_id : value, action : "getStates"} 
        });

        request.done(function(msg) { 
         
            $("#states").html( msg );
        });

        request.fail(function(jqXHR, textStatus) {
          alert( "Request failed: " + textStatus );
        });

  });


});

</script>


<script>

    $(function() {

  $('#states').bind('change', function(ev) {

     var value = $(this).val();

      var request = $.ajax({
          url: "ajax.php",
          type: "POST",
          data: {state_id : value, action : "getCities"} 
        });

        request.done(function(msg) { 
          $("#cities").html( msg );
        });

        request.fail(function(jqXHR, textStatus) {
          alert( "Request failed: " + textStatus );
        });

  });


});

</script>