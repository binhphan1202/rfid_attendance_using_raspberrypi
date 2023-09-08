<?php
require 'config.php';

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    $sql = "SELECT * FROM get_rfid ORDER BY time_create";

    $q = $pdo->query($sql);

    $q->setFetchMode(PDO::FETCH_ASSOC);

} catch (PDOException $e){
    die("Error connecting database: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en"  dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DangKy</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <style>
            body{ font: 14px sans-serif; }
            .wrapper{ float: left; width: 30%; padding: 20px; margin: 20px; height: 420px; }
            .box{ margin: auto; width: 60%; height: 50%;}
            .table_size{margin: auto; width: 70%;}
            table {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 18px;
                border-collapse: collapse;
                width: 50%;
                text-align: center;
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
                                            <a class="nav-link" href="#" style="font-size: 20px; color: white;">Information</a>
                                        </li>
                                    </ul>
                                    <!-- Left links -->
                                    <div id="search">
                                        <form class="d-flex">
                                            <input class="form-control me-2" type="search" name="content" placeholder="Search" aria-label="Search">
                                            <input class="btn btn-outline-light" type="submit" name="search" value="Search">
                                            <?php
                                                if(isset($GET_["search"])) {
                                                    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
                                                    $content = $_GET['content'];
        
                                                    $sql = "SELECT * FROM get_rfid WHERE mssv='$content'";
                                                    $qr = $conn->query($sql);
                                                        
                                                    while($row = $qr->fetch(PDO::FETCH_ASSOC)){
                                                        echo $row['mssv'];
                                                    }
                                                    $conn->close();
                                                }
                                            ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <!-- Container wrapper -->
                        </nav>
                        <!-- Navbar -->
                    </div>
                    <?php require "content.php"; ?>
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
