<?php
require_once('../config.php');
db_connect();

$sql = "INSERT INTO users (userName, emailId, userPassword) VALUES (?, ?, ?)";
$statement = $conn->prepare($sql);
$statement->bind_param('sss', $_POST['userName'], $_POST['userEmailId'], $_POST['userPassword']);

if ($statement->execute()) {
    redirect_to('../index.html?signup=true');
} else {
    die($conn->error);
}
