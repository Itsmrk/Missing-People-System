<?php

//fetch_comment.php
$servername = "localhost";
$username = "root";
$password = "";
$db = "mpfrs";
// Create connection
$connect = new PDO("mysql:host=$servername;dbname=mpfrs", $username, $password);
//$connect = new PDO('mysql:host=localhost;dbname=testing', 'root', '');

$query = "
SELECT * FROM comments 
WHERE parent_comment_id = '0' 
and post_id = '".$_GET['post_id']."'
ORDER BY comment_id DESC
"; 
$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$output = '';
foreach($result as $row)
{
 $output .= '
 <div class="panel panel-default">
  <div class="panel-heading">By <b>'.$row["name"].'</b> on <i>'.$row["cdate"].'</i></div>
  <div class="panel-body">'.$row["comment"].'</div>
  <div class="panel-footer" align="right"><button type="button" class="btn btn-dark reply" id="'.$row["comment_id"].'">Reply</button>
  </div>
 </div>
 ';
 $output .= get_reply_comment($connect, $row["comment_id"]);
}

echo $output;

function get_reply_comment($connect, $parent_id = 0, $marginleft = 0)
{
 $query = "
 SELECT * FROM comments WHERE parent_comment_id = '".$parent_id."'
 ";
 $output = '';
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $count = $statement->rowCount();
 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 48;
 }
 if($count > 0)
 {
  foreach($result as $row)
  {
   $output .= '
   <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
    <div class="panel-heading">By <b>'.$row["name"].'</b> on <i>'.$row["cdate"].'</i></div>
    <div class="panel-body">'.$row["comment"].'</div>
    <div class="panel-footer" align="right"><button type="button" class="btn btn-dark reply" id="'.$row["comment_id"].'">Reply</button>
    </div>
   </div>
   ';
   $output .= get_reply_comment($connect, $row["comment_id"], $marginleft);
   
  }
 }
 return $output;
}

?>
