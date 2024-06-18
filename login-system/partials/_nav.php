<?php

// session_start();
$loggedin = false;

if (isset($_SESSION['loggedin'])) {
    $loggedin = true;
}
?>

<nav class="navbar bg-primary navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/login-system">m-Secure</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php

                if (!$loggedin) {
                    echo '<li class="nav-item">
                        <a class="nav-link" href="/login-system/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login-system/signup.php">Sign up</a>
                    </li>';
                } else {
                    echo '<li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/login-system/welcome.php">Home</a>
                    </li>';
                }

                ?>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>