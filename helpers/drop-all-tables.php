<?php
// I called this script just a few times :)
$conn = new mysqli('localhost', 'root', '', 'mysql');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Well have to drop all of the tables.
$dropBtc = "DROP TABLE btc";
$dropEth = "DROP TABLE eth";
$dropLastHourData = "DROP TABLE lasthourdata";

if ($conn->query($dropBtc) === FALSE || $conn->query($dropEth) === FALSE || $conn->query($dropLastHourData) === FALSE) {
    echo "Could not drop table: " . $conn->error;
}
$conn->close();
?>
