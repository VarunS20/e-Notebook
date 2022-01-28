<?php
require_once('../config.php');
db_connect();
$notebook_name = $_POST["notebook_name"];
$book_content = $_POST["book_content"];
$sql = "UPDATE notebooks SET noteBookName = '$notebook_name', bookContent = '$book_content' WHERE id = ?";
$statement = $conn->prepare($sql);
$statement->bind_param('s', $_GET['id']);

if ($statement->execute()) {
    redirect_to('../userPortal.php');
} else {
    die("There has been an error, please try again after some time");
}
