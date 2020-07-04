<?php include "header.php"; ?> 
<?php include "menu.php"; ?> 
<?php
    if(!isset($_SESSION['email'])){
    header('Location: login.php');
    }
?>
<?php
    $session_email = $_SESSION['email'];
    //$session_user_image = $_SESSION['user_image'];
?>


<div class="container-fluid w-100 float-left position-relative">
    <div class="row">
        <div class="col-md-3">
            <?php include "side_menu.php"; ?>   
        </div>
        <div class="col-md-9">
             <h1 class="text-primary pt-4 h1-s">
                <i class="fas fa-plus-square"></i> Add Post : <small>Add New Post</small>
            </h1>
            <hr>
            <nav aria-label="breadcrumb bc-s">
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard / </a></li>
                    <li class="active pl-1"><i class="fas fa-plus-square"></i> Add Post </li>
                </ol>
            </nav>  
            
             <!----------------- Submit Button PHP Starts ------------------>
            
             <?php
                    if(isset($_POST['submit'])){
                        $date = date('Y-m-d');

                        $title = mysqli_real_escape_string($con,$_POST['title']);
                        //$post_data = mysqli_real_escape_string($con,$_POST['post-data']);
                        $categories = $_POST['categories'];
                       // $tags = mysqli_real_escape_string($con,$_POST['tags']);
                        //$status = $_POST['status'];
                        $gender = $_POST['gender'];
                        $countries = $_POST['countries'];
                        $states = $_POST['states'];
                        $cities = $_POST['cities'];
                        $image = $_FILES['image']['name'];
                        $tmp_name = $_FILES['image']['tmp_name'];
                        $person_name = $_POST['person_name'];
                        $age = $_POST['age'];
                        $contact_no = $_POST['contact_no'];
                        $address = $_POST['address'];
                        $missing_date = $_POST['missing_date'];
                     //   $views = $_POST['views'];
                        if(empty($title) or empty($image) or empty($person_name) or empty($age) or empty($gender) or empty($categories) or empty($countries) or empty($states) or empty($cities) or empty($contact_no) or empty($address)){
                            $error = "All (*) Fields Are Required";
                            
                        }
                        else{
                            $insert_query = "INSERT INTO `posts` (`cdate`, `title`, `user`, `image`, `person_name`, `age`, `gender`, `categories`, `countries`, `states`, `cities`, `contact_no`, `address`, `missing_date`, `views`, `status`) VALUES ('$date', '$title', '$session_email', '$image', '$person_name', '$age', '$gender', '$categories', '$countries', '$states', '$cities', '$contact_no', '$address', '$missing_date', '0', 'draft')";
                            if(mysqli_query($con, $insert_query)){
                                
                                $msg = "Post Has Been Added Successfully";
                                $path = "assets/images/$image";
                                
                                $title = "";
                                //$tags = "";
                                $gender = "";
                                $countries = "";
                                $states = "";
                                $cities = "";
                                $contact_no = "";
                                
                                //$views = "";
                                //$status = "";
                                $categories = "";
                                
                                /*if(move_uploaded_file($tmp_name, $path)){
                                    copy($path, "..assets/images/$path");
                                }*/
                            }
                            else{
                                $error = "Post Has Not Been Added Successfully";
                            }
                        }
                    }
                    ?>
                    
                    <!----------------- Submit Button PHP End ------------------>
                    
                
                    <form action="" method="post" enctype="multipart/form-data">
                       <div class="row">
                       <div class="col-md-8  ">
                         <div class="container">
                          <div class="row">
                          
                              <?php
                                    if(isset($msg)){
                                        echo "<span class='pull-right' style='color:green;'>$msg</span>";
                                    }
                                    else if(isset($error)){
                                        echo "<span class='pull-right' style='color:red;'>$error</span>";
                                    }
                                ?>
                          
                          <div class="card w-100 mt-3">
                        <div class="card-header">
                          <div class="row align-items-center">
                            <div class="col-8">
                              <h3 class="mb-0"> Add Missing Person Details </h3>
                            </div>
                            
                             <!----------------- Submit Button HTML Starts ------------------>
                            
                            <div class="col-4 text-right">
                              <input type="submit" value="Add Post" name="submit" class="btn btn-primary">
                              
                            </div>
                            
                            <!----------------- Submit Button HTML End ------------------>
                            
                          </div>
                        </div>
                        <div class="card-body w-">
                          
                          <div class="pl-lg-4">
                             <div class="row">
                               
                               <!----------------- Post Type HTML & PHP Starts ------------------>
                               
                                <div class="col-lg-6">
                                  <h6 class="heading-small text-muted mb-4">Post Type</h6>
                                  <div class="form-group">
                                   <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Categories:*</h6>
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
                                
                                 <!----------------- Post Type HTML & PHP End ------------------>
                                 
                                <!----------------- Missing Since HTML & PHP Starts ------------------>
                                
                                <div class="col-lg-6">
                                  <h6 class="heading-small text-muted mb-4">Missing Since</h6>
                                  <div class="form-group">
                                   <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Missing Date:*</h6>
                                        <input name="missing_date" type="date" placeholder="mm/dd/yyyy" id="" value="<?php if(isset($missing_date)){echo date('Y-m-d', strtotime($missing_date));}?>" class="form-control">
                                  </div>
                                </div>
                                
                                <!----------------- Missing Since HTML & PHP End ------------------>
                                
                              </div>
                            </div>
                            
                            <!----------------- User Information HTML & PHP Starts ------------------>
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
                                   <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Person Name:*</h6>
                                    <input type="text" id="person" name="person_name" class="form-control" placeholder="Enter Person Name" value="<?php if(isset($person_name)){echo $person_name;}?>">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                 <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Gender:*</h6>
                                            <select class="form-control" name="gender" id="gender">
                                                <option value="male" <?php if(isset($gender) and $gender == 'male'){echo "selected";}?>>Male</option>
                                                <option value="female" <?php if(isset($gender) and $gender == 'female'){echo "selected";}?>>Female</option>
                                                <option value="others" <?php if(isset($gender) and $gender == 'others'){echo "selected";}?>>Others</option>
                                            </select>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                   <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Age:*</h6>
                                    <input type="text" id="age" name="age" class="form-control" placeholder="Enter Missing Person Age" value="<?php if(isset($age)){echo $age;}?>">
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                            <!----------------- User Information HTML & PHP End ------------------>
                            
                            <!----------------- Contact Information HTML & PHP Starts ------------------>
                            
                            <hr class="my-4">
                            <!-- Address -->
                            <h6 class="heading-small text-muted mb-4">Contact Information</h6>
                            <div class="pl-lg-4">
                              <div class="row">
                                
                                <div class="col-lg-6">
                                  <div class="form-group">
                                  <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Countries:*</h6>
                                    <select class="form-control-label w-100" name="countries" id="countries">
                                        <option value="">Select Country</option>
                                        
                                            <?php  
                                                $cou_query = "SELECT country_name,country_id FROM countries";
                                                $cou_run = mysqli_query($con, $cou_query);
                                   
                                            ?> 
                                            <?php 
                                                
                                                if(mysqli_num_rows($cou_run) > 0){
                                                    while($cou_row = mysqli_fetch_array($cou_run)){
                                                        $country_id = $cou_row['country_id'];
                                                        $cou_name = $cou_row['country_name'];
                                                         echo "<option value='".$country_id."' ".((isset($country) and $country == $cou_name)?"selected":"").">".ucfirst($cou_name)."</option>";
                                                        
                                                    }
                                                }
                                                ?>
                                    </select>
                                  </div>
                                </div>
                                
                                <div class="col-lg-3">
                                   <div class="form-group">
                                       <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">States:*</h6>
                                            <select class="form-control-label  w-100" name="states" id="states">
                                                <option value="">Select States</option>
                                            </select>
                                   </div>
                                </div>
                                
                                <div class="col-lg-3">
                                   <div class="form-group">
                                       <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Cities:*</h6>
                                            <select class="form-control-label  w-100" name="cities" id="cities">
                                                <option value="">Select City</option>
                                            </select>
                                   </div>
                                </div>
                                
                                <div class="col-lg-6">
                                  <div class="form-group">
                                   <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Contact No:*</h6>
                                            <input type="text" name="contact_no" placeholder="Enter Contact No" id="contact" value="<?php if(isset($contact_no)){echo $contact_no;}?>" class="form-control">
                                  </div>
                                  
                                </div>
                                <div class="col-lg-12 text-left">
                                  <div class="form-group">
                                   <h6 class="pb-2 mb-0 text-primary border-bottom border-primary">Address:*</h6>
                                    
                                    <textarea id="address" name="address" class="form-control text-left" placeholder="Enter Address">
                                        <?php if(isset($address)){echo $address;}?>
                                    </textarea>
                                  </div>
                                </div>
                                
                              </div>
                              
                            </div>
                            
                            <!----------------- Contact Information HTML & PHP End ------------------>
                            
                            <!----------------- Choose Image HTML & PHP Starts ------------------>
                            
                            <hr class="my-4">
                            <h6 class="heading-small text-muted mb-4">Choose Image</h6>
                            <div class="pl-lg-4">
                             <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <h6 class="pb-2 mb-0 text-primary">Choose Profile Image:*</h6>
                                    <input type="file" id="image" name="image">
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                            <!----------------- Choose Image HTML & PHP End ------------------>
                            
                          </form>
                        </div>
                      </div>
                          
                             </div>
                           
                           </div>
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

<!----------------- Missing Date Picker Calender JS Starts ------------------>

<script>
        $('#missing_date').datepicker({
            uiLibrary: 'bootstrap4'
        });
</script>

<!----------------- Missing Date Picker Calender JS End ------------------>

<!----------------- States, Cities, Countries Dropdown JS Starts ------------------>

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


<!----------------- States, Cities, Countries Dropdown JS End ------------------>