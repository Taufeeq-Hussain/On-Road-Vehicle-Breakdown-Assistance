<?php
require_once "config.php";

// Check if the 'id' parameter is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the user with the given ID from the database
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

// Redirect back to the display page after removing the user
header("Location: display.php");
exit();
?>
