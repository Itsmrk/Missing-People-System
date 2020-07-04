<?php include "header.php"; ?> 
<?php include "menu.php";  
/*
    if(!isset($_SESSION['username'])){
        $_SESSION['msg'] = "You Must Loged In First To View This Page";
    header('Location: login.php');
    }

    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
    header('Location: login.php');
    }*/
?>

<div class="container-fluid w-100 float-left position-relative">
    <div class="row">
        <div class="col-md-3">
            <?php include "side_menu.php"; ?>   
        </div>
        <div class="col-md-9">
            <?php include "dashboard.php"; ?>   
        </div>
    </div>
</div>

       

<?php include "footer.php"; ?>