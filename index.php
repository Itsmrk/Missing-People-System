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
               <div class="row">
                <?php include "posts.php"; ?> 
                
            
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