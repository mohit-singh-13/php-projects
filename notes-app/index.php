<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";

$insert = false;

try {
    $connection = mysqli_connect($servername, $username, $password, $database);
    // echo "Connection is successful";
} catch (Exception $e) {
    die("Failed to connect to database due to : " . $e->getMessage());
}

// echo $_SERVER['REQUEST_METHOD'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['desc'];

    // echo '<h1>' . $title . '</h1>';

    try {
        $sql = "INSERT INTO notes (title, description) VALUES ('$title', '$description')";
        $result = mysqli_query($connection, $sql);

        $insert = true;
    } catch (Exception $e) {
        echo "Failed to insert record into Database due to : " . $e->getMessage();
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>M-Notes : Making notes taking easy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
</head>

<body>
    <!-- Modal -->
    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
        Edit Modal
    </button> -->

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/crud-application/index.php">M-Notes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>


    <?php
    if ($insert) {
        echo "<div aria-live='polite' aria-atomic='true' class='position-relative'>
        <div class='toast-container top-0 end-0 p-3'>
          <div class='toast fade show' role='alert' aria-live='assertive' aria-atomic='true'>
            <div class='toast-header'>
              <svg class='bd-placeholder-img rounded me-2' width='20' height='20' xmlns='http://www.w3.org/2000/svg' aria-hidden='true' preserveAspectRatio='xMidYMid slice' focusable='false'><rect width='100%' height='100%' fill='#007aff'></rect></svg>
              <strong class='me-auto'>Successful</strong>
              <small class='text-body-secondary'>just now</small>
              <button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
            <div class='toast-body'>
              Record has been inserted successfully
            </div>
          </div>
        </div>
      </div>";

        //   $insert = false;
    }
    ?>


    <!-- Form -->
    <div class="container my-4">
        <h2>Add a Note</h2>
        <form action="/crud-application/index.php" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Note Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Leave a comment here" id="desc" style="height: 100px"
                    name="desc"></textarea>
                <label for="desc">Notes Description</label>
            </div>
            <button type="submit" class="btn btn-success">Add Note</button>
        </form>
    </div>


    <div class="container my-4">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No.</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM notes";
                $result = mysqli_query($connection, $sql);
                $sno = 1;

                while ($row = mysqli_fetch_assoc($result)) {
                    // echo var_dump($row);
                    // echo $row['sno'] . ". Title : " . $row['title'] . ", Description : " . $row['description'] . ", Time : " . $row['tstamp'];
                    // echo "<br/>";
                
                    echo "<tr>
                        <th scope='row'>$sno</th>
                        <td>$row[title]</td>
                        <td>$row[description]</td>
                        <td><a href='/edit' data-bs-toggle='modal' data-bs-target='#editModal'>Edit</a> <a href='/delete'>Delete</a></td>
                    </tr>";

                    $sno += 1;
                }
                ?>
            </tbody>
        </table>
        <hr>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
        integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>

</body>

</html>