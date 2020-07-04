<!-- header -->
<?php include "header.php"; ?> 
<!-- slider -->

<?php   
if(isset($_SESSION['user']['admin'])){
    //$session_role = $_SESSION['role'];
    $session_email = $_SESSION['email'];
    $session_role = $_SESSION['role'];
}
?>
<!-- ======================================== PHP ============================================  -->
<?php 

if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];
    
    $views_query = "UPDATE `posts` SET `views` = views + 1 WHERE `posts`.`post_id` = $post_id";
    mysqli_query($con, $views_query);
    
    $query = "SELECT * FROM posts WHERE status = 'publish' and post_id = $post_id";
    $run = mysqli_query($con, $query);
    if(mysqli_num_rows($run) > 0){
        $row = mysqli_fetch_array($run);
        $id = $row['post_id'];
        $day = date('d', strtotime($row['cdate']));
        $mon_year = date('M, Y', strtotime($row['cdate']));
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
        $address = $row['address'];
        $missing_date = $row['missing_date'];
        $contact_no = $row['contact_no'];
        $post_data = $row['post_data'];
        $views = $row['views'];
        $status = $row['status'];
    }
    else{
        header('Location: index.php');
    }
}      
?>

<!-- ==============single_post ============================ -->
<section class="w-100  mt-5 pb-5 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="posts bg-white mt-4 ">
                <div class="container">
                    <div class="row">
                       <div class="text-center w-100">
                            <img class="rounded-circle border border-primary sp_img" src="assets/images/<?php echo $image;?>">
                        </div>            
                        <div class="col-md-4 post-title py-4 ">
                            <h4 class="pb-2 mb-0 text-primary  border-bottom border-primary">Title: <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php echo $title;?></p>  </h4>
                                     
                        </div>
                        <div class="col-md-4 py-4 ">
                           <h4 class="pb-2 mb-0 text-primary  border-bottom border-primary">Category: 
                           <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php echo $categories;?></p>  </h4>
                        </div>
                        
                        <div class="col-md-4 py-4 ">
                           <h4 class="pb-2 mb-0 text-primary  border-bottom border-primary">Age: 
                           <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php echo $age;?></p>  </h4>
                        </div>
                    
                        <div class="col-md-3 py-3">
                            <h4 class="pb-2 mb-0 text-primary text-center  border-bottom border-primary">Person Name</h4>
                            <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php echo ucfirst($person_name);?> </p>
                        </div>
                        
                        <div class="col-md-3 py-3">
                            <h4 class="pb-2 mb-0 text-primary text-center  border-bottom border-primary">Gender</h4>
                            <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php echo ucfirst($gender);?> </p>
                        </div>
                        <div class="col-md-3 py-3">
                            <h4 class="pb-2 mb-0 text-primary text-center  border-bottom border-primary">Missing Date: </h4>
                            <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php echo date('d M, Y', strtotime($missing_date));?></p>
                        </div>
                        <div class="col-md-3 py-3">
                            <h4 class="pb-2 mb-0 text-primary text-center  border-bottom border-primary">Post Date: </h4>
                            <p class="bg-light text-center text-uppercase text-secondary py-3 h6">
                                <?php echo $day;?> <?php echo $mon_year;?>
                            </p>
                        </div>
                        <div class="col-md-3 py-3">
                            <h4 class="pb-2 mb-0 text-primary text-center  border-bottom border-primary">Country</h4>
                            <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php 
                                    $Res_C = mysqli_query($con, "SELECT country_name from countries where country_id = ". $countries);
                                    $Row_C = mysqli_fetch_array($Res_C); echo $Row_C[0];
                                ?></p>
                        </div>
        
                        <div class="col-md-3 py-3">
                            <h4 class="pb-2 mb-0 text-primary text-center  border-bottom border-primary">State</h4>
                            <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php 
                                    $Res_C = mysqli_query($con, "SELECT state_name from states where state_id = ". $states);
                                    $Row_C = mysqli_fetch_array($Res_C); echo $Row_C[0];
                                ?></p>
                        </div>
                        <div class="col-md-3 py-3">
                            <h4 class="pb-2 mb-0 text-primary text-center  border-bottom border-primary">City</h4>
                            <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php 
                                    $Res_C = mysqli_query($con, "SELECT city_name from cities where city_id = ". $cities);
                                    $Row_C = mysqli_fetch_array($Res_C); echo $Row_C[0];
                                ?></p>
                        </div>
                        <div class="col-md-3 py-3 text-center">
                             <h4 class="pb-2 mb-0 text-primary text-center  border-bottom border-primary">Contact No.</h4>
                             <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php echo ucfirst($contact_no);?> </p>
                        </div>
                        <div class="col-md-12 py-3">
                            <h4 class="pb-2 mb-0 text-primary text-center  border-bottom border-primary">address:</h4>
                            <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php echo ucfirst($address);?> </p>
                        </div>
                    </div>
                </div>
            </div>
                    <!-- comments -->
                    <?php
                    
                    if(isset($_GET['post_id'])){
                    $post_id = $_GET['post_id'];
                    $c_query = "SELECT * FROM comments WHERE post_id = $post_id ORDER BY comment_id DESC";
                    $c_run = mysqli_query($con,$c_query);
                        
                    }
                    if(mysqli_num_rows($c_run) > 0){
                ?>
                    <div class="container pb-5">
                       <?php
                        while($c_row = mysqli_fetch_array($c_run)){
                            $c_id = $c_row['comment_id'];
                            $c_name = $c_row['name'];
                            $c_date = date($c_row['cdate']);
                            $c_username = $c_row['username'];
                            $c_image = $c_row['image'];
                            $c_comment = $c_row['comment'];
                        
                        ?>   
                        <?php 
                        }
                        ?>
                    </div>
                    <?php
                        } ?>
                       
            </div>
                
        </div>
    </div>
</section>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 
  
  <div class="container">
   <form method="POST" id="comment_form">
   
    <div class="form-group">
     <input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="Enter Your Name" />
    </div>
    
    <div class="form-group">
     <input type="text"  id="contact_no" name="contact_no" class="form-control" placeholder="Your Contact Number Here">
    </div>
    <div class="form-group">
     <input type="email" id="email" name="email" class="form-control" placeholder="Your Email Address Here">
    </div>
    <div class="form-group">
     <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5"></textarea>
    </div>
    <div class="form-group">
     <input type="hidden" name="comment_id" id="comment_id" value="0" />
     <input type="hidden" name="post_id" id="post_id" value="<?=$_GET["post_id"]?>" />
     
     <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit" />
    </div>
   </form>
   <span id="comment_message"></span>
   <br />
   <div id="display_comment"></div>
  </div>



<script>
$(document).ready(function(){
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"add_comment.php",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
   {
    if(data.error != '')
    {
     $('#comment_form')[0].reset();
     $('#comment_message').html(data.error);
     $('#comment_id').val('0');
     load_comment();
    }
   }
  })
 });

 load_comment();

 function load_comment()
 {
   
 var vUrl = "fetch_comment.php?post_id=" + <?=$_GET['post_id']?>;
  $.ajax({
   url:vUrl ,
   method:"POST",
   success:function(data)
   { 
    $('#display_comment').html(data);
   }
  })
 }

 $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_name').focus();
 });
 
/*$(document).on('click', '.delete',function deletecomment(id) {

       if(confirm("Are you sure you want to delete this comment?")) {

            $.ajax({
            url: "comment_delete.php",
            type: "POST",
            data: 'comment_id='+id,
            success: function(data){
                if (data)
                {
                    $("#comment-"+id).remove();
                    if($("#count-number").length > 0) {
                        var currentCount = parseInt($("#count-number").text());
                        var newCount = currentCount - 1;
                        $("#count-number").text(newCount)
                    }
                }
            }
           });
        }
     });*/
});
    

</script>


<!-- footer -->
<?php include "footer.php"; ?> 