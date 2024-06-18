<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $showAlert = false;
    $showError = false;
    $login = false;

    include "partials/_dbconnect.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

    // $hash = password_hash($password, PASSWORD_DEFAULT);
    // $bool = password_verify($password, $hash);
    // $hash = substr($hash, 0, 25);
    // echo $hash;
    // echo $password;

    // $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($connection, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $login = true;
            
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
    
            header("location: welcome.php");
        }
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require "partials/_nav.php" ?>

    <?php
    if (isset($_POST["username"])) {
        if (!$login) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Failed!</strong> Invalid Credentials
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        } else {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> You're logged in
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
    }
    ?>

    <div class="container d-flex flex-column align-items-center mt-5">
        <h1 class="text-center border-bottom border-3 border-primary">Login to your account</h1>

        <form action="/login-system/login.php" method="post" class="col-md-6 d-flex flex-column mt-4">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>