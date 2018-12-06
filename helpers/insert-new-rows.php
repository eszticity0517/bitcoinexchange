<?php
// Let's start with bitcoin.
$huf = $_POST['huf'];
$bitcoinJson = file_get_contents("https://www.tidebit.com//api/v2/tickers/btchkd.json");
$bitcoinArray = json_decode($bitcoinJson, true);
$btcTicker = array_values($bitcoinArray) [1];
$conn = new mysqli('localhost', 'root', '', 'mysql');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$timestamp = array_values($bitcoinArray) [0];
$requestTime = date('Y-m-d H:i:s', $timestamp);
$btcBuyValue = array_values($btcTicker) [0] / $huf;
$btcSellValue = array_values($btcTicker) [1] / $huf;
$lowValue = array_values($btcTicker) [2] / $huf;
$highValue = array_values($btcTicker) [3] / $huf;
$lastValue = array_values($btcTicker) [4] / $huf;
$openValue = array_values($btcTicker) [5] / $huf;
$volValue = array_values($btcTicker) [6] / $huf;

$addRowToBtc = "INSERT INTO btc (requestTime, huf, buyValue, sellValue, lowValue, highValue, lastValue, openValue, volValue)
    VALUES ('" . $requestTime . "','" . $huf . "','" . $btcBuyValue . "','" . $btcSellValue . "','" . $lowValue . "','" . $highValue . "','" . $lastValue . "','" . $openValue . "','" . $volValue . "' )";

// Continue with ethereum
$ethereumJson = file_get_contents("https://www.tidebit.com//api/v2/tickers/ethusd.json");
$ethereumArray = json_decode($ethereumJson, true);
$ethTicker = array_values($ethereumArray) [1];
$ethBuyValue = array_values($ethTicker) [0] / $huf;
$ethSellValue = array_values($ethTicker) [1] / $huf;
$lowValue = array_values($ethTicker) [2] / $huf;
$highValue = array_values($ethTicker) [3] / $huf;
$lastValue = array_values($ethTicker) [4] / $huf;
$openValue = array_values($ethTicker) [5] / $huf;
$volValue = array_values($ethTicker) [6] / $huf;

$addRowToEth = "INSERT INTO eth (requestTime, huf, buyValue, sellValue, lowValue, highValue, lastValue, openValue, volValue)
    VALUES ('" . $requestTime . "','" . $huf . "','" . $ethBuyValue . "','" . $ethSellValue . "','" . $lowValue . "','" . $highValue . "','" . $lastValue . "','" . $openValue . "','" . $volValue . "' )";

// And finish with mixed data
$addRowToLastHourData = "INSERT INTO lasthourdata (requestTime, huf, btcBuyValue, btcSellValue, ethBuyValue, ethSellValue)
    VALUES ('" . $requestTime . "','" . $huf . "','" . $btcBuyValue . "','" . $btcSellValue . "','" . $ethBuyValue . "','" . $ethSellValue . "' )";

if ($conn->query($addRowToBtc) === FALSE || $conn->query($addRowToEth) === FALSE || $conn->query($addRowToLastHourData) === FALSE) {
    echo "Error creating table in main.php: " . $conn->error;
}

$conn->close();
?>
