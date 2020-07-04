<!-- header -->
<?php include "header.php"; ?> 
<!-- Search -->
<?php include "search.php"; ?>
<!-- slider -->
<?php// include "slider.php"; ?> 
<!-- blog -->
<section class="w-100 float-left pt-3 bg-light ">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
               <?php

  $number_of_posts = 5;
                
      
      
      
?>
<!-- =========================================================================================  --->
<?php

$posts_start_from=0;
   
if(isset($_POST['search'])){
$and  = "";    
    $person_name = $_POST['person_name'];
    if($person_name != ""){
        $and .= " and person_name LIKE '%$person_name%'";
    }
    
    
    $gender = $_POST['gender'];
    if($gender != ""){
        $and .= " and gender = '$gender'";
    }
    
     $categories = $_POST['categories'];
    if($categories != ""){
        $and .= " and categories = '$categories'";    
    }
    
    $countries = $_POST['countries'];
    if($countries != ""){
        $and .= " and countries = '$countries'";
    }
    $states = $_POST['states'];
    if($states != ""){
        $and .= " and states = '$states'";
    }
    
    $cities = $_POST['cities'];
    if($cities != ""){
        $and .= " and cities = '$cities'";
    }
    $age_id = $_POST['cities'];
    if($cities != ""){
        $and .= " and cities = '$cities'";
    }
     $date= $_POST['cdate'];
    if($date != ""){
        $and .= " and cdate = '$date'";
    }
    
    
    
   
    }
   

        $query = "SELECT * FROM posts WHERE status = 'publish' and categories = 'Found'";
        $query .=  $and;
        $query .= " ORDER BY post_id DESC LIMIT $posts_start_from, $number_of_posts";
   //echo $query;
$run = mysqli_query($con,$query);
if(mysqli_num_rows($run) > 0){
    while($row = mysqli_fetch_array($run)){
        $id = $row['post_id'];
        $day = date('d', strtotime($row['cdate']));
        $mon_year = date('M, Y', strtotime($row['cdate']));
        /*$date = getdate($row['cdate']);
        $day = $date['mday'];
        $month = $date['month'];
        $year = $date['year'];*/
        $title = $row['title'];
        $user = $row['user'];
        $user_image = $row['user_image'];
        $image = $row['image'];
        $person_name = $row['person_name'];
        $age = $row['age'];
        $gender = $row['gender'];
        $categories= $row['categories'];
        $countries = $row['countries'];
        $states = $row['states'];
        $cities = $row['cities'];
        $contact_no = $row['contact_no'];
        $post_data = $row['post_data'];
        $views = $row['views'];
        $status = $row['status'];
        
?>
<div class="posts col-md-3 ">
  
        <div class="row">
           <div class="mt-2 mx-2 rounded">
            <div class="bg-primary text-white w-100 text-center">
                <span class="text-white"> <?php echo strtoupper($categories);?></span>
            </div>
          
           <a href="single_post.php?post_id=<?php echo $id;?>"class="w-100 p-img pb-5 d-inline-block">
                <img style="height:137px;" class="w-100" src="assets/images/<?php echo $image;?>">
           </a>
           
            <div class="w-100 bg-white post-title py-1 s-detail ">
                <p class="paragraph mb-0">Name: <span class="ml-1 "> <?php echo ucfirst($person_name);?> </span></p>
            </div>
           
          
            </div>
        </div>
    </div>

<?php
     }
}
else{
    echo "<center><h2>No Posts Available</h2></center>";
}
?>
<div class="col-md-12 mt-2">
<nav aria-label="...">
  <ul class="pagination justify-content-center">
 <!--   <li class="page-item ">
      <span class="page-link">Previous</span>
    </li> -->
    <?php
        for($i = 1; $i <= $total_pages; $i++){
            echo "
                <li class='page-item  ".($page_id == $i ? 'active': ' ')."'>
                    <a class='page-link' href='index.php?page=".$i."&".(isset($cat_name)?"category=$category_id":" ")."' >$i</a>
                </li>";
        }
        ?>    
  <!--  <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li> -->
  </ul>
</nav>
</div>
            </div>
            <div class="col-md-4 ">
                <?php include "sidebar.php"; ?> 
            </div>
        </div>
    </div>
</section>




<!-- footer -->
<?php include "footer.php"; ?> 


<script>

    $(function() {

  $('#countries').bind('change', function(ev) {

     var value = $(this).val();
//alert(value);
      var request = $.ajax({
          url: "ajax.php",
          type: "POST",
          data: {country_id : value, action : "getStates"} 
        });

        request.done(function(msg) { 
          $("#states").html( msg );
            alert($("#states").html( msg ));
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