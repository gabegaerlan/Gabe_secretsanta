<?php
    include'db.php';
    $conn = getDatabaseConnection();
    
    $sql = "DELETE FROM users
            WHERE userId = ". $_GET['userId'];
            
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    header("Location: index.php");

?>