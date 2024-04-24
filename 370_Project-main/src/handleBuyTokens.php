<?php
include 'DBConnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $buyerEmail = $_POST['buyerEmail'];
    $tokenPackage = $_POST['tokenPackage'];

    // Update student's token count
    $sql = "UPDATE student SET tokenCnt = tokenCnt + ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $tokenPackage, $buyerEmail);

    if ($stmt->execute()) {
        echo "Transaction successful. Tokens have been added to your account.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
