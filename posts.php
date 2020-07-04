<?php

  $number_of_posts = 20;
      
      if(isset($_GET['page'])){
          $page_id = $_GET['page'];
      }
      else{
          $page_id = 1;
      }
      
      if(isset($_GET['cat'])){
          $category_id = $_GET['cat'];
          $cat_query = "SELECT * FROM categories WHERE category_id = '$category_id'";
          $cat_run = mysqli_query($con, $cat_query);
          $cat_row = mysqli_fetch_array($cat_run);
          $categories = $cat_row['category'];
      }

?>
<!-- =========================================================================================  --->
<?php

$posts_start_from=0;
   
if(isset($_POST['search'])){
$and  = "";    
    $person_name = $_POST['person_name'];
    if($person_name != ""){
        $and .= " and person_name = '$person_name'";
    }
    $gender = $_POST['gender'];
    if($gender != ""){
        $and .= " and gender = '$gender'";
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
    /*$age_id = $_POST['age_id'];
    if($age_id != ""){
        $and .= " and age_id = '$age_id'";
    }*/
     $date= $_POST['cdate'];
    if($date != ""){
        $and .= " and cdate = '$date'";
    }
    }



    if($_POST['categories'] != ""){
            echo $and .= " and categories = '".$_POST['categories']."'";    
    } elseif($categories != '') {
         $and .= " and categories = '$categories'";    
    } else {
        $categories = '';
    }

        $query = "SELECT * FROM posts WHERE status = 'publish' ";
        $query .=  $and;
        $query .= " ORDER BY post_id DESC LIMIT $posts_start_from, $number_of_posts";
   //echo $query;
$run = mysqli_query($con,$query);
if(mysqli_num_rows($run) > 0){
    while($row = mysqli_fetch_array($run)){
        $id = $row['post_id'];
        $day = date('d', strtotime($row['cdate']));
        $mon_year = date('M, Y', strtotime($row['cdate']));
        $title = $row['title'];
        $user = $row['user'];
        $user_image = $row['user_image'];
        $image = $row['image'];
        $person_name = $row['person_name'];
        $age = $row['age'];
        //$age_id = $row['age_id'];
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
<div class="posts col-md-4 col-sm-6 col-6 ">
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
    <?php
        for($i = 1; $i <= $total_pages; $i++){
            echo "
                <li class='page-item  ".($page_id == $i ? 'active': ' ')."'>
                    <a class='page-link' href='index.php?page=".$i."&".(isset($cat_name)?"category=$category_id":" ")."' >$i</a>
                </li>";
        }
        ?>    
  </ul>
</nav>
</div>