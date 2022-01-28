<?php
require_once('config.php');
if (!isset($_SESSION['userId'])) {
    redirect_to('index.html');
}
db_connect();

$sql = "SELECT id, userId, noteBookName, bookContent FROM notebooks WHERE id = ?";
$statement = $conn->prepare($sql);
$statement->bind_param('s', $_GET['id']);
$statement->execute();
$statement->store_result();
$statement->bind_result($id, $userId, $noteBookName, $bookContent);
$statement->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Notebook</title>

    <link rel="stylesheet" href="vendor/bootstrap-4.6.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/summernote/summernote-bs4.css">
</head>

<body>
    <div class="container">
        <?php include_once('header.php'); ?>

        <div>
            <h4 class="mb-4">
                <a href="userPortal.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                    </svg> Back
                </a>
            </h4>
            <div class="card">
                <div class="card-header font-weight-bold">
                    <?php echo $noteBookName; ?>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $bookContent; ?></p>
                </div>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap-4.6.1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/summernote/summernote-bs4.min.js"></script>

    <script>
        $(function() {
            $('.textarea').summernote({
                toolbar: [
                    ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['view', ['codeview']]
                ]
            })
        })
    </script>
</body>

</html>