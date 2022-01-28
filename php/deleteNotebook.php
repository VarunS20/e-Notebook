<?php
require_once('../config.php');
db_connect();
$sql = "DELETE FROM notebooks WHERE id=?";
$statement = $conn->prepare($sql);
$statement->bind_param('s', $_GET['id']);
if ($statement->execute()) {
    redirect_to('../userPortal.php');
} else {
    echo $conn->error;
}
