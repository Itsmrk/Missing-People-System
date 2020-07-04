<div class=" bg-search w-100">


<form class="search_here" action="index.php" method="POST" enctype="multipart/form-data">
<div class="container">
   <div class="row">
    
    <div class="col-12 text-center pb-4 mb-4">
    <h1 class="text-white hb relative">
        Search Here Your Missing Loved Ones
    </h1>
    </div>

    <!--Name Starts Here-->
    <div class="col-12 col-md-4 col-sm-12 col-lg-2 pl-md-0">
        <div class="form-group p-0">
            <input type="text" class="form-control" id="person_name" name="person_name" placeholder="Enter Name" title="Please Enter Your Name">
        </div>
    </div>
    <!--Name Ends Here-->

    <!--Gender Starts Here-->
    <div class="col-12 col-md-4 col-sm-12 col-lg-1 pl-md-0">
        <div class="form-group">
        <select class="form-control p-0" name="gender" id="gender" title="Please selete Gender form list">
           <option value="">Gender</option>
            <option value="male"   <?php if(isset($gender) and $gender == 'male'){echo "selected";}?>>Male</option>
            <option value="female" <?php if(isset($gender) and $gender == 'female'){echo "selected";}?>>Female</option>
            <option value="others" <?php if(isset($gender) and $gender == 'others'){echo "selected";}?>>Others</option>
        </select>
    </div>
    </div>
    <!--Gender Ends Here-->

    <!--categories Starts Here-->
    <div class="col-12 col-md-4 col-sm-12 col-lg-2 pl-md-0">
        <div class="form-group">
      <select class="form-control" name="categories" id="categories" title="Please selete Category form list">
           <option value="" class="text-sm-2">Select category </option>
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
    <!--Country Starts here-->
    
    <div class="col-12 col-md-4 col-sm-12 col-lg-2 pl-md-0">
        <div class="form-group">
    <select class="form-control form-control-label w-100" name="countries" id="countries" title="Please selete Country form list">
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
    <!--Country Ends here-->

    <!--Province Starts here-->
    <div class="col-12 col-md-4 col-sm-12 col-lg-2 pl-md-0">
        <div class="form-group">
    <select class="form-control form-control-label  w-100" name="states" id="states" title="Please selete Province form list">
        <option value="">Select Province</option>
    </select>
    </div>
    </div>
    <!--Province Ends here-->

    <!--City Starts here-->
    <div class="col-12 col-md-4 col-sm-12 col-lg-2 pl-md-0">
        <div class="form-group">
   
    <select class="form-control form-control-label  w-100" name="cities" id="cities" title="Please selete City form list">
        <option value="">Select City</option>
    </select>
    </div>
    </div>
    <!--City Ends here-->
    
     <!--<div class="form-group">
					<label for="from date">Age:</label>
					<select class="form-control-label  w-100" name="age_id" id="age_id">
                        
                    <?php/*
                    $age_query = "SELECT * FROM age_range ORDER BY age_id ASC";
                    $age_run = mysqli_query($con, $age_query);
                    if(mysqli_num_rows($age_run) > 0){
                        while($age_row = mysqli_fetch_array($age_run)){
                            $age_from = $age_row['age_from'];
                            $age_to = $age_row['age_to'];
                            $age_id = $age_row['age_id'];
                            echo "<option value='".$age_id."' ".((isset($age_id) and $age_id == $age_from)?"selected":"").">".ucfirst($age_from)." to ".ucfirst($age_to)."</option>";

                        }
                    }*/
                    ?>
                    
                    </select>
    </div>-->
  

    <div class="col-12 col-sm-12 col-lg-1 col-12 text-center pl-md-0 pl-sm-3">
        <input type="submit" class="bg-primary text-white border-0 w-100 py-2 small px-2 rounded" name="search" id="search">
    </div>

    <?php if(isset($error)){?>
    <div class="alert alert-danger">
    <strong><?php echo $error; ?></strong>
    </div>
    <?php }?>
    
    </div>
</div>
    </form> 
</div>