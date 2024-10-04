<?php
// process.php
require_once 'config.php'; // Include the database connection

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the submitted values
    $userId = $_POST['id'];
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $pword = htmlspecialchars($_POST['pword']);

    // Hash the password before saving it
    $hashed_pword = password_hash($pword, PASSWORD_DEFAULT);

    // Prepare the SQL statement
    $sql = "UPDATE tbl_user SET phone = :phone, email = :email, pword = :pword WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':pword', $hashed_pword);
    $stmt->bindParam(':id', $_SESSION['user_id']); // Get the user ID from the session

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error updating profile: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn = null;
}
?>