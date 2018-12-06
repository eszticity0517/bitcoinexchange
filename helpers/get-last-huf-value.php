<?php
$conn = new mysqli('localhost', 'root', '', 'mysql');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$getLastRow = "SELECT huf FROM btc ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $getLastRow);
$return_arr = Array();

// Interesting technique...
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $row_array['huf'] = $row['huf'];
    array_push($return_arr, $row_array);
}

$conn->close();

// When table is empty, we need an initial HUF value to get started with the first row.
$final = 250;
if (sizeof($return_arr) > 0) {
    $final = array_values(array_values($return_arr) [0]) [0];
}

print_r($final);

$conn->close();
?>
