<?php
require_once 'dbconnect.php';
if (!isset($_SESSION)) {
    session_start();
}
$sql = 'select l.laptop_id,b.brand_name as brand,l.model,l.ram,l.cpu,l.hdd, l.display,l.color,l.year,l.filepath
from laptop l, brand b
where l.brand=b.brand_id;';
try {
    $stmt = $conn->query($sql);
    $laptops = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // print_r($brand);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>View Laptop</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #cfa6a3;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="img/logo.avif" style="height:60px; width: 60px;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row pt-5">
            <div class="col-md-2 col-sm-12">
                <div><a href="newBrand.php">Insert New Brand</a></div>
                <div><a href="viewBrand.php">View Brand Info</a></div>
                <div><a href="newLaptop.php">Insert New Laptop</a></div>
                <div><a href="viewLaptop.php">View Laptop</a></div>
            </div>
            <div class="col-md-10 col-sm-12">

                <h3 class="text-center">Laptop Information</h3>
                <p><?php
                    if (isset($_SESSION['insertSuccess'])) {
                        echo "<span class='alert alert-success'>$_SESSION[insertSuccess]</span>";
                        unset($_SESSION['insertSuccess']);
                    }
                    if (isset($_SESSION['deleteLaptopSuccess'])) {
                        echo "<span class='alert alert-success'>$_SESSION[deleteLaptopSuccess]</span>";
                        unset($_SESSION['deleteLaptopSuccess']);
                    }
                    ?></p>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Laptop ID</th>
                            <th>Brand Name</th>
                            <th>Model</th>
                            <th>Ram</th>
                            <th>CPU</th>
                            <th>HDD</th>
                            <th>Display</th>
                            <th>Color</th>
                            <th>Year</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($laptops)) {
                            foreach ($laptops as $laptop) {
                                echo "<tr>
                                        <td>$laptop[laptop_id]</td>
                                        <td>$laptop[brand]</td>
                                        <td>$laptop[model]</td>
                                        <td>$laptop[ram]</td>
                                        <td>$laptop[cpu]</td>
                                        <td>$laptop[hdd]</td>
                                        <td>$laptop[display]</td>
                                        <td>$laptop[model]</td>
                                        <td>$laptop[year]</td>
                                        <td><img src=$laptop[filepath] style='height:100px;width:100px;'></td>
                                        <td>
                                            <a class='btn btn-primary' href='editLaptop.php?id=$laptop[laptop_id]'>Edit</a>
                                        </td>
                                        <td>
                                            <a class='btn btn-danger' href='deleteLaptop.php?id=$laptop[laptop_id]'>Delete</a>
                                        </td>
                                </tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>