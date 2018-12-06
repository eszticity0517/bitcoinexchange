<?php
// I needed this script just once in the beginning.
$conn = new mysqli('localhost', 'root', '', 'mysql');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// We have to create three tables.
$createBtc = "CREATE TABLE IF NOT EXISTS btc (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        requestTime DATETIME NOT NULL,
        huf FLOAT(6),
        buyValue FLOAT(6),
        sellValue  FLOAT(6),
        lowValue  FLOAT(6),
        highValue  FLOAT(6),
        lastValue FLOAT(6),
        openValue FLOAT(6),
        volValue FLOAT(6)
    )";

$createEth = "CREATE TABLE IF NOT EXISTS eth (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        requestTime DATETIME NOT NULL,
        huf FLOAT(6),
        buyValue FLOAT(6),
        sellValue  FLOAT(6),
        lowValue  FLOAT(6),
        highValue  FLOAT(6),
        lastValue FLOAT(6),
        openValue FLOAT(6),
        volValue FLOAT(6)
    )";

$createLastHourData = "CREATE TABLE IF NOT EXISTS lasthourdata (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        requestTime DATETIME NOT NULL,
        huf FLOAT(6),
        btcBuyValue FLOAT(6),
        btcSellValue  FLOAT(6),
        ethBuyValue FLOAT(6),
        ethSellValue  FLOAT(6)
    )";

if ($conn->query($createBtc) === FALSE || $conn->query($createEth) === FALSE || $conn->query($createLastHourData) === FALSE) {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
