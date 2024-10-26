<?php
    //Connecting Database
    $insert = false;
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "vnotes";

    $conn = mysqli_connect($servername, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: ". mysqli_connect_error());
    }




    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $title = $_POST['title'];
        $description = $_POST['description'];



        //Create SQL query
        $sql = "INSERT INTO `notes` (title, description) VALUES ('$title', '$description')";
        //Execute the query
        $result = mysqli_query($conn, $sql);
        if($result){
            $insert = true;
        }
        else{
            $insert = false;
        }

    }
?>




<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#notesTable').DataTable();
        } );
    </script>
    <title>vNotes - Notes taking made easy</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">vNotes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/CRUD">Home</a>
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

    if($insert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Cool!</strong> Your note has been inserted!.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>



    <div class="container mt-4">
        <h3>Add A Note</h3>
        <form action="/CRUD/index.php" method="post">
    <div class="mb-3">
        <label for="title" class="form-label">Note Title</label>
        <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp">
    </div>
    <label for="description" class="form-label">Note Description</label>
    <div class="form-group">
        <textarea class="form-control" id="floatingTextarea2" name="description" style="height: 100px"></textarea>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Add Note</button>
</form>

    </div>


    <div class="container my-4" >

        <table class="table" id="notesTable">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
        $sql = "SELECT * FROM notes";
        $result = mysqli_query($conn,$sql);
        $sno = 0;
        while($row = mysqli_fetch_assoc($result)){
            $sno = $sno+1;
            echo "<tr>
            <th scope='row'>".$sno. "</th>
            <td>".$row['title']. "</td>
            <td>".$row['description']. "</td>
            <td>actions</td>
          </tr>";
            // echo "ID: ". $row["sno"]. " - Title: ". $row["title"]. " - Description: ". $row["description"]. "<br>";
        }
        ?>

            </tbody>
        </table>
    </div>

</body>

</html>