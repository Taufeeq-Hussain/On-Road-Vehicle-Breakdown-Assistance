<?php
$sql = "SELECT COUNT (*) AS row_count FROM mechanics"

$result = $conn->query($sql);
$row = $result->fetch_assoc();
$count = $row["row_count"];

echo $count;
?>