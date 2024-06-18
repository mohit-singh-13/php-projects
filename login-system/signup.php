<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $showAlert = false;
    $showError = false;

    include "partials/_dbconnect.php";

    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];

    // $exists = false;
    $existsSql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($connection, $existsSql);

    $num_records = mysqli_num_rows($result);

    if (($password == $cpassword) && ($num_records == 0)) {
        try {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            // echo "$hash";
            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hash')";
            $result = mysqli_query($connection, $sql);
        } catch (Exception $e) {
            $showAlert = true;
        }
    } else if ($password != $cpassword) {
        $showError = "Please enter exact same password";
    } else {
        $showError = "Username already exists";
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require "partials/_nav.php" ?>

    <?php
    if (isset($_POST["username"])) {
        if ($showAlert) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Failed!</strong> Your account could not been created successfully
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        } else if ($showError) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Failed! </strong>" . $showError . "
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        } else {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> Your account has been created successfully
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
    }
    ?>

    <div class="container d-flex flex-column align-items-center mt-5">
        <h1 class="text-center border-bottom border-3 border-primary">Sign up to our website</h1>

        <form action="/login-system/signup.php" method="post" class="col-md-6 d-flex flex-column mt-4">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="confirmpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword">
            </div>
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>