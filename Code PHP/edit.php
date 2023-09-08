<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Info</title>
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
                text-align:center;
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
                <div class="container">
                    <div class="mb-3">
                        <header>
                            <h1 style="font-family: Courier New; text-align: center; font-size: 40px; color: blue;">
                            Ho Chi Minh University of Technology & Education
                            </h1>
                        </header>
                    </div>
                    <?php
                    // Kết nối Database
                    include 'config.php';
                    $rfid=$_GET['rfid'];
                    $query=mysqli_query($conn,"SELECT * from get_rfid where rfid='$rfid'");
                    $row=mysqli_fetch_assoc($query);
                    ?>
                    <div class="page-content">
                        <div class="container">
                            <h3 style="font-family: Ebrima; font-size: 35px; text-align:center;">Edit Users</h3>
                            <div class="row">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title" style="font-family: Gadugi; text-align: center; font-size: 28px;">Update Users Information&nbsp;</h4>
                                            <form method="POST" class="form">
                                                <div class="mb-3">
                                                    <label for="rfid" class="form-label">Student RFID</label>
                                                    <input type="text" class="form-control" value="<?php echo $row['rfid']; ?>" name="rfid" readonly><br/>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Student Name</label>
                                                    <input type="text" class="form-control" value="<?php echo $row['name']; ?>" name="name" placeholder="Name"><br/>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="mssv" class="form-label">MSSV</label>
                                                    <input type="text" class="form-control" value="<?php echo $row['mssv']; ?>" name="mssv" placeholder="ID"><br/>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="create" class="form-label">Date Modified</label>
                                                    <input type="text" class="form-control" value="<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); 
                                                                                                    echo date('Y-m-d H:i:s');?>" name="create" readonly><br/>
                                                </div>
                                                <input type="submit" class="btn btn-primary" value="Update" name="update_user">
                                                
                                                <?php
                                                if (isset($_POST['update_user'])){
                                                    $rfid=$_GET['rfid'];
                                                    $name=$_POST['name'];
                                                    $mssv=$_POST['mssv'];
                                                    

                                                // Create connection
                                                    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
                                                    // Check connection
                                                    if ($conn->connect_error) {
                                                    die("Connection failed: " . $conn->connect_error);
                                                }

                                                $sql = "UPDATE get_rfid SET name='$name', mssv='$mssv', time_create=CURRENT_TIMESTAMP WHERE rfid='$rfid'";


                                                if ($conn->query($sql) === TRUE) {
                                                    echo "Error updating record: " . $conn->error;
                                                    header("Location: list.php");
                                                } else {
                                                    echo "Record updated successfully";
                                                    header("Location: list.php");
                                                }

                                                $conn->close();
                                                }
                                                ?>
                                            </form>
                                        </div>
                                    </div>
                                    
                            </div>
                            <br>
                            <div class="mb-3">
                                <a class="btn btn-dark" href="list.php" style="font-size: 20px;">Back</a>
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