<?php
include("config/db.php"); // Make sure path is correct

$new_password = "admin123"; // whatever password you want
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

$query = "UPDATE admin SET password='$hashed_password' WHERE username='admin'";

if(mysqli_query($conn, $query)){
    echo "Password updated successfully!";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>