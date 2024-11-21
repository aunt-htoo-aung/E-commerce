<?php
require_once 'dbconnect.php';
try {
    $sql = "select * from brand";
    $stmt = $conn->query($sql);
    $brands = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e->getMessage();
}

if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    echo ' on the server';
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $ram = $_POST['ram'];
    $cpu = $_POST['cpu'];
    $hdd = $_POST['hdd'];
    $display = $_POST['display'];
    $color = $_POST['color'];
    $year = $_POST['year'];
    $filename = $_FILES['laptop_img']['name'];
    $coverpath = 'cover/' . $filename;
    move_uploaded_file($_FILES['laptop_img']['tmp_name'], $coverpath);
    $sql = 'insert into laptop (brand,model,ram,cpu,hdd,display,color,year,filepath) values (?,?,?,?,?,?,?,?,?)';
    try {
        $stmt = $conn->prepare($sql);
        $status = $stmt->execute([$brand, $model, $ram, $cpu, $hdd, $display, $color, $year, $coverpath]);
        if ($status) {
            echo "insert successful";
            header('location:viewLaptop.php');
        } else {
            echo 'false';
        }
        // print_r($brand);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
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

    <title>Hello, world!</title>
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

                <h3 class="bg-light text-center">Insert New Laptop</h3>

                <div class="col-lg-6 mb-3">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                        <select class="form-select mb-3" name="brand">
                            <option selected>Choose Brand</option>
                            <?php
                            if (isset($brands)) {
                                foreach ($brands as $brand) {
                                    echo "<option value=$brand[brand_id]>$brand[brand_name]</option>";
                                }
                            }
                            ?>


                        </select>
                        <div class="mb-3">
                            <label for="model" class="form-label">Model</label>
                            <input type="text" class="form-control" name="model">
                        </div>
                        <div class="mb-3">
                            <label for="ram" class="form-label">RAM</label>
                            <input type="text" class="form-control" name="ram">
                        </div>
                        <div class=" mb-3">
                            <label for="cpu" class="form-label">CPU</label>
                            <input type="text" class="form-control" name="cpu">
                        </div>
                        <div class="mb-3">
                            <label for="hdd" class="form-label">HDD</label>
                            <input type="text" class="form-control" name="hdd">
                        </div>
                        <div class="mb-3">
                            <label for="display" class="form-label">Display</label>
                            <input type="text" class="form-control" name="display">
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label">Colour</label>
                            <input type="text" class="form-control" name="color">
                        </div>
                        <div class="mb-3">
                            <label for="year" class="form-label">Year</label>
                            <input type="number" class="form-control" name="year">
                        </div>
                        <div class="mb-3">
                            <label for="filepath" class="form-label">Laptop Image</label>
                            <input type="file" class="form-control" name="laptop_img">
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                </div>
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