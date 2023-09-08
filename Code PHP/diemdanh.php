<?php
require 'config.php';

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    $sql1 = "SELECT * FROM checkin ORDER BY time";
    $sql2 = "SELECT * FROM checkout ORDER by time";

    $q1 = $pdo->query($sql1);
    $q2 = $pdo->query($sql2);

    $q1->setFetchMode(PDO::FETCH_ASSOC);
    $q2->setFetchMode(PDO::FETCH_ASSOC);

} catch (PDOException $e){
    die("Error connecting database: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en"  dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="refresh" content="1">
        <title>Attendance</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <style>
            body{ font: 14px sans-serif; }
            .wrapper{ float: left; width: 30%; padding: 20px; margin: 20px; height: 420px; }
            .box{ margin: auto; width: 60%; height: 50%;}
            .table_size{margin: auto; width: 70%;}
            table {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 50%;
                text-align: center;
                font-size: 18px;
            }
            td, th {
                border: 1px solid #ddd;
                padding: 8px;
            }
            th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div id="layout-wrapper">
            <div class="main-content">
                <div class="container-fluid">
                    <div class="mb-3">
                        <header>
                            <h1 style="font-family: Courier New; text-align: center; font-size: 40px; color: blue;">
                            Ho Chi Minh University of Technology & Education
                            </h1>
                        </header>
                    </div>
                    <div class="mb-3">
                        <!-- Navbar -->
                        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                        <!-- Container wrapper -->
                            <div class="container-fluid">
                                <!-- Collapsible wrapper -->
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                        <li class="nav-item">
                                            <a class="nav-link" href="diemdanh.php" style="font-size: 20px; color: white;">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="list.php" style="font-size: 20px; color: white;">Information</a>
                                        </li>
                                    </ul>
                                    <!-- Left links -->
                                    <form class="d-flex" method="post" action="search.php">
                                        <input class="form-control me-2" type="search" name="content" placeholder="Search" aria-label="Search">
                                        <button class="btn btn-outline-light" type="submit" name="search">Search</button>
                                    </form>
                                    <?php
                                        if(isset($POST_['search'])) {
                                            $content = $_POST['content'];
                                        }
                                    ?>
                                </div>
                            </div>
                        <!-- Container wrapper -->
                        </nav>
                        <!-- Navbar -->
                    </div>
                    <div class="page-content">
                        <div class="container-fluid">
                            <h3 style="font-family: Ebrima; font-size: 35px; text-align:center;">ATTENDANCE</h3>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title" style="font-family: Gadugi; text-align: center; font-size: 28px;"><b>Checkin List&nbsp;</b></h4>
                                            <table class="table table-bordered" id="myTableIn">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th scope="col">Student RFID</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">MSSV</th>
                                                        <th scope="col">Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($row = $q1->fetch()): ?>
                                                        <tr>
                                                            <td><?php echo htmlspecialchars($row['rfid']) ?></td>
                                                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['mssv']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['time']); ?></td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <br>
                                    <form>
                                    <input type="submit" class="btn btn-warning" value="Clear" name="clearin">
                                    <?php
                                    if (isset($_GET['clearin'])){
                                        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
                                        // Check connection
                                        if($conn->connect_error){
                                            die("Connection failed: " . $conn->connect_error);
                                        }

                                        $sql = "TRUNCATE TABLE checkin";

                                        if($conn->query($sql) == TRUE) {
                                            echo "<script>alert('Table truncated successfully')</alert>";
                                        }
                                        else {
                                            echo "<script>alert('Error truncating table: ' . $conn->error)</script>";
                                        }
                                        $conn->close();
                                    }
                                    ?>
                                    </form>
                                </div>

                                <div class="col-xl-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title" style="font-family: Gadugi; text-align: center; font-size: 28px;"><b>Checkout List&nbsp;</b></h4>
                                            <table class="table table-bordered" id="myTableOut">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th scope="col">Student RFID</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">MSSV</th>
                                                        <th scope="col">Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($row = $q2->fetch()): ?>
                                                        <tr>
                                                            <td><?php echo htmlspecialchars($row['rfid']) ?></td>
                                                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['mssv']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['time']); ?></td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <br>
                                    <form>
                                    <input type="submit" class="btn btn-warning" value="Clear" name="clearout">
                                    <?php
                                    if (isset($_GET['clearout'])){
                                        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
                                        // Check connection
                                        if($conn->connect_error){
                                            die("Connection failed: " . $conn->connect_error);
                                        }

                                        $sql = "TRUNCATE TABLE checkout";

                                        if($conn->query($sql) == TRUE) {
                                            echo "<script>alert('Table truncated successfully')</alert>";
                                        }
                                        else {
                                            echo "<script>alert('Error truncating table: ' . $conn->error)</script>";
                                        }
                                        $conn->close();
                                    }
                                    ?>
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <br><br>
    <footer class="bg-light text-center text-lg-start">
        <!-- Copyright -->
        <div class="text-left p-3" style="background-color: #f0f0f5;">
            <h3 style="font-size: 18px; font-family: cursive;"><i>Phan Le Thanh Binh-20146149</i></h3>
            <h3 style="font-size: 18px; font-family: cursive;"><i>Le Thi Nhu Quynh-20146409</i></h3>
        </div>
        <!-- Copyright -->
    </footer>
</html>
