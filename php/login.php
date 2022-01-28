<?php
require_once('../config.php');
db_connect();

$email = $_POST['userAuthEmailId'];
$password = $_POST['userAuthPassword'];

$sql = "SELECT id, userName, emailId, userPassword FROM users WHERE emailId = ?";
$statement = $conn->prepare($sql);
$statement->bind_param('s', $email);
if ($statement->execute()) {
    $statement->store_result();
    $statement->bind_result($id, $userName, $email, $userPassword);
    $statement->fetch();
    if (strcmp($password, $userPassword) == 0) {
        $_SESSION['userId'] = $id;
        $_SESSION['firstName'] = $userName;
        redirect_to('../userPortal.php');
    } else {
        redirect_to('../index.html?loginFailed=true');
    }
}
