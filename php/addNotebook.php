<?php
require_once('../config.php');
db_connect();
$sql = "INSERT INTO notebooks (userId, noteBookName, bookContent) VALUES (?, ?, ?);";
$statement = $conn->prepare($sql);
$statement->bind_param('sss', $_SESSION['userId'], $_POST['notebook_name'], $_POST['bookContent']);
if ($statement->execute()) {
    redirect_to('../userPortal.php');
} else {
    die("There has been an error, please try again after some time");
}
