<?php
$conn = new mysqli('localhost', 'root', '', 'mysql');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = mysqli_query($conn, "SELECT * FROM lasthourdata");
$return_arr = Array();
// Echo for AJAX

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $row_array['requestTime'] = $row['requestTime'];
    $row_array['huf'] = $row['huf'];
    $row_array['btcBuyValue'] = $row['btcBuyValue'];
    $row_array['btcSellValue'] = $row['btcSellValue'];
    $row_array['ethBuyValue'] = $row['ethBuyValue'];
    $row_array['ethSellValue'] = $row['ethSellValue'];
    array_push($return_arr, $row_array);
}

mysqli_close($conn);
echo json_encode($return_arr);
?>
