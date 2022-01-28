<?php
require_once('config.php');
if (!isset($_SESSION['userId'])) {
    redirect_to('index.html');
}
db_connect();
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
            <form action="php/addNotebook.php" method="post">
                <div class="mb-3">
                    <label for="notebook_name" class="form-label">Notebook Name</label>
                    <input type="text" class="form-control" name="notebook_name" id="notebook_name" required placeholder="Give your Notebook a name">
                </div>
                <div class="mb-3">
                    <label for="floatingTextarea" class="form-label">Notebook</label>
                    <textarea class="textarea" placeholder="Your Notes goes Here..." name="bookContent" id="floatingTextarea"></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Notebook</button>
                </div>
            </form>
        </div>

        <div class="mt-4">
            <h4>Your Notebooks</h4>
            <table class="table border">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Sl.No</th>
                        <th scope="col">Notebook Name</th>
                        <th scope="col">Read</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $userId = $_SESSION['userId'];
                    $sql = "SELECT id, noteBookName, bookContent FROM notebooks WHERE userId = $userId";
                    $statement = $conn->query($sql);
                    $i = 1;
                    if ($statement) {
                        if ($statement->num_rows > 0) {
                            while ($result = $statement->fetch_assoc()) {
                    ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $result['noteBookName']; ?></td>
                                    <td><a href="readNotebook.php?id=<?php echo $result['id']; ?>">Read</a></td>
                                    <td><a href="editNotebook.php?id=<?php echo $result['id']; ?>">Edit</a></td>
                                    <td><a href="php/deleteNotebook.php?id=<?php echo $result['id']; ?>">Delete</a></td>
                                </tr>
                            <?php
                                $i++;
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="4">No Notebooks Found. Go ahead and add some Notebooks.</td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
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