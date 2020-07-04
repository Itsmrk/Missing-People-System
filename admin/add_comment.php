<?php

//add_comment.php

$servername = "localhost";
$username = "root";
$password = "";
// Create connection
$connect = new PDO("mysql:host=$servername;dbname=mpfrs", $username, $password);
//$connect = new PDO('mysql:host=localhost;dbname=testing', 'root', '');

$error = '';
$comment_name = '';
$email = '';
$contact_no = '';
$comment_content = '';

if(empty($_POST["comment_name"]))
{
 $error .= '<p class="text-danger">Name is required</p>';
}
else
{
 $comment_name = $_POST["comment_name"];
}

if(empty($_POST["email"]))
{
 $error .= '<p class="text-danger">Email is required</p>';
}
else
{
 $email = $_POST["email"];
}

if(empty($_POST["contact_no"]))
{
 $error .= '<p class="text-danger">Contact Number is required</p>';
}
else
{
 $contact_no = $_POST["contact_no"];
}

if(empty($_POST["comment_content"]))
{
 $error .= '<p class="text-danger">Comment is required</p>';
}
else
{
 $comment_content = $_POST["comment_content"];
}

if($error == '')
{
 $query = "
 INSERT INTO comments 
 (parent_comment_id, name, email, contact_no, comment, post_id) 
 VALUES (:parent_comment_id, :name, :email, :contact_no, :comment, :post_id)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':parent_comment_id' => $_POST["comment_id"],
   ':name' => $comment_name,
   ':email' => $email,
   ':contact_no' => $contact_no,
   ':comment'    => $comment_content,
      ':post_id'    =>  $_POST["post_id"],
  )
 );
 $error = '<label class="text-success">Comment Added</label>';
}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>