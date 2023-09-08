<?php
    include_once('config.php');
    if(isset($_REQUEST['rfid']) and $_REQUEST['rfid']!=""){
    $rfid=$_GET['rfid'];
    $sql = "DELETE FROM get_rfid WHERE rfid='$rfid'";
    if ($conn->query($sql) === TRUE) {
        echo "Delete success";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
    }
?>