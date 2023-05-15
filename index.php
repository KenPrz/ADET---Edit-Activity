<?php
include "connection.php";
// Form Submission Handler
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['id'] as $key => $value) {
        $id = mysqli_real_escape_string($conn, $value);
        $name = mysqli_real_escape_string($conn, $_POST['name'][$key]);
        $username = mysqli_real_escape_string($conn, $_POST['username'][$key]);
        $email = mysqli_real_escape_string($conn, $_POST['email'][$key]);
        $password = mysqli_real_escape_string($conn, $_POST['password'][$key]);
        $sql = "UPDATE `users`
            SET `name` = '$name', `username` = '$username', `email` = '$email', `password` = '$password'
            WHERE `id` = '$id'";
        mysqli_query($conn, $sql);
    }
    echo '<script>alert("Changes saved successfully!");</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <?php
    // Pagination configuration
    $pageLimit = 10; // Number of entries per page
    $page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
    
    // Calculate the offset for database query
    $offset = ($page - 1) * $pageLimit;

    // Retrieve data from the database with LIMIT and OFFSET
    $query = "SELECT * FROM users LIMIT $pageLimit OFFSET $offset";
    $result = mysqli_query($conn, $query);

    // Calculate total number of pages
    $queryCount = "SELECT COUNT(*) as total FROM users";
    $resultCount = mysqli_query($conn, $queryCount);
    $rowCount = mysqli_fetch_assoc($resultCount);
    $totalPages = ceil($rowCount['total'] / $pageLimit);
    ?>
<div class="row m-1">
    <div class="col-8 m-2">
        <form method="post">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <?php
                        $id = $row['id'];
                        $name = htmlspecialchars($row['name']);
                        $username = htmlspecialchars($row['username']);
                        $email = htmlspecialchars($row['email']);
                        $password = htmlspecialchars($row['password']);
                        ?>
                        <tr>
                            <td>
                                <?= $id ?>
                            </td>
                            <td><input type="text" name="name[]" value="<?= $name ?>"></td>
                            <td><input type="text" name="username[]" value="<?= $username ?>"></td>
                            <td><input type="text" name="email[]" value="<?= $email ?>"></td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="showPassword<?= $id ?>"
                                        onclick="togglePassword('password<?= $id ?>')">
                                    <input type="password" name="password[]" value="<?= $password ?>"
                                        id="password<?= $id ?>">
                                </div>
                            </td>
                            <input type="hidden" name="id[]" value="<?= $id ?>">
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-6">
                    <!-- Pagination links -->
                    <ul class="pagination">
                        <?php if ($page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $totalPages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $page + 1 ?>">Next</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="col-6">
                    <input type="submit" value="Save" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </div>
</div>
</body>

</html>
<script>
function togglePassword(inputId) {
        const passwordInput = document.getElementById(inputId);
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
</script>
<?php $conn->close() ?>