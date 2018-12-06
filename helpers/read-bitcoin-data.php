<?php

$conn = new mysqli('localhost', 'root', '', 'mysql');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = mysqli_query($conn, "SELECT * FROM btc");
// Echo array for AJAX
$return_arr = Array();

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $row_array['requestTime'] = $row['requestTime'];
    $row_array['huf'] = $row['huf'];
    $row_array['buyValue'] = $row['buyValue'];
    $row_array['sellValue'] = $row['sellValue'];
    $row_array['lowValue'] = $row['lowValue'];
    $row_array['highValue'] = $row['highValue'];
    $row_array['lastValue'] = $row['lastValue'];
    $row_array['openValue'] = $row['openValue'];
    $row_array['volValue'] = $row['volValue'];
    array_push($return_arr, $row_array);
}

mysqli_close($conn);
echo json_encode($return_arr);
?>
