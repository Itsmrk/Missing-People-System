<?php include "connect.php"; ?>

<?php
//require_once ("db.php");
$commentId = isset($_POST['id']) ? $_POST['id'] : "";
$comment = isset($_POST['comment']) ? $_POST['comment'] : "";
$Name = isset($_POST['name']) ? $_POST['name'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$contact_no = isset($_POST['contact_no']) ? $_POST['contact_no'] : "";
$cdate = date('Y-m-d H:i:s');

$sql = "INSERT INTO comments (parent_comment_id, cdate, name, email, contact_no, comment ) VALUES ('" . $commentId . "','" . $cdate . "','" . $Name . "','" . $email . "','" . $contact_no . "','" . $comment . "')";

$result = mysqli_query($con, $sql);

if (! $result) {
    $result = mysqli_error($con);
}
echo $result;
?>
