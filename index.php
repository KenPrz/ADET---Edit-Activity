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
    // Retrieve data from the database
    $sql = "SELECT * FROM `users`";
    $result = mysqli_query($conn, $sql);
    ?>
    <div class="row">
        <div class="col-8">
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
                <input type="submit" value="Save" class="btn btn-primary float-right">
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