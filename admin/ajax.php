<?php
include "../connect.php";

if($_POST["action"] == "getStates"){
    $country_id = $_POST["country_id"];
                                                
    if (! empty($country_id)) {
        
        
        
       $query = "SELECT * FROM states WHERE country_id = '" . $country_id . "'"; 
         $cou_run = mysqli_query($con, $query);
        ?>
         <option value="">Select State</option>
        <?php
         if(mysqli_num_rows($cou_run) > 0){
                while($cou_row = mysqli_fetch_array($cou_run)){
                    $state_id = $cou_row['state_id'];
                    $state_name = $cou_row['state_name'];
                     echo "<option value='".$state_id."' >".ucfirst($state_name)."</option>";

                }
            }
        
        
    
    }
                                            
}

if($_POST["action"] == "getCities"){
    $state_id = $_POST["state_id"];
                                                
    if (! empty($state_id)) {
        
        
        
       $query = "SELECT * FROM cities WHERE state_id = '" . $state_id . "'"; 
         $cou_run = mysqli_query($con, $query);
        ?>
         <option value="">Select City</option>
        <?php
         if(mysqli_num_rows($cou_run) > 0){
                while($cou_row = mysqli_fetch_array($cou_run)){
                    $city_id = $cou_row['city_id'];
                    $city_name = $cou_row['city_name'];
                     echo "<option value='".$city_id."' >".ucfirst($city_name)."</option>";

                }
            }
        
        
    
    }
                                            
}

?>




