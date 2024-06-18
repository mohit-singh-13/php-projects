<?php

session_start();

if (!isset($_SESSION['loggedin']) /*|| ($_SESSION['loggedin'] != true)*/) {
    session_unset();
    session_destroy();
    header("location: login.php");
    exit();
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome - <?php echo $_SESSION['username'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require "partials/_nav.php" ?>

    <!-- <?php
    echo $_SESSION['username']
    ?> -->

    <div class="container mt-5">
        <div class="alert alert-success d-grid gap-4" role="alert">
            <h4 class="alert-heading">Welcome <?php echo $_SESSION['username'] ?>!</h4>
            <p>Hey, how are you doin? You are logged in successfully and this is one and only page in this website. Hope you're doing well.
                You can logout using the following button. Thank You.
            </p>
            <hr>
            <a href="/login-system/logout.php" class="btn btn-danger btn-lg">Logout</a>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>