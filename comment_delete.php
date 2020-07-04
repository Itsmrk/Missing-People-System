<?php
include "../connect.php";
$servername = "localhost";
$username = "root";
$password = "";
$db = "mpfrs";
// Create connection
$connect = new PDO("mysql:host=$servername;dbname=mpfrs", $username, $password);

$comment_id = $_POST['comment_id'];

$sql_del = "DELETE FROM comments WHERE comment_id = $comment_id";
$stmt = $conn->prepare($sql_del);
$stmt->execute();

if (! empty($stmt)) {
    echo true;
}
?>