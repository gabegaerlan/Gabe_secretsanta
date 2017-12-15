<?php
session_start();
include './db.php';


function loginProcess() 
{
    $conn = getDatabaseConnection();
    if (isset($_POST['login']))// check if <form> is pressed 
    {
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
        
        $sql = "SELECT *
            FROM users
            WHERE username = :username 
            AND   password = :password ";
        
        $namedParameters = array();
        $namedParameters[':username'] = $username;
        $namedParameters[':password'] = $password;
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($namedParameters);
        $record = $stmt->fetch();
        
        if (empty($record)) 
        {
        
        echo "<center>Incorrect Username or Password</center>";
        
        } 
        else 
        {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $record['username'];
            $_SESSION['fullName'] = $record['firstName'] . "  " . $record['lastName'];
        
            header("Location: wishlist.php");
        }
    }
}

function loginAdmin() 
{
    $conn = getDatabaseConnection();
    if (isset($_POST['login']))// check if <form> is pressed 
    {
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
        
        $sql = "SELECT *
            FROM admin
            WHERE username = :username 
            AND   password = :password ";
        
        $namedParameters = array();
        $namedParameters[':username'] = $username;
        $namedParameters[':password'] = $password;
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($namedParameters);
        $record = $stmt->fetch();
        
        if (empty($record)) 
        {
        
        echo "<center>Incorrect Username or Password</center>";
        
        } 
        else 
        {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $record['username'];
            $_SESSION['fullName'] = $record['firstName'] . "  " . $record['lastName'];
            $_SESSION['admin'] = $record['firstName'].''.$record['lastName'];
        
            header("Location: wishlist.php");
        }
    }
}

function signup()
{
    $conn = getDatabaseConnection();
    function userList()
    {
        global $conn;
        $sql = "SELECT *
                FROM users
                ORDER BY userId";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    if(isset($_GET['addUser']))// The addUser form has been pressed
    {
        $sql = "INSERT INTO users(firstName,lastName,username,password)
                VALUES(:firstName,:lastName,:username,:password)";
        $np = array();
        
        $np[':firstName'] = $_GET['firstName'];
        $np[':lastName'] = $_GET['lastName'];
        $np[':username'] = $_GET['username'];
        $np[':password'] = sha1($_GET['password']);
        
        $stmt=$conn->prepare($sql);
        $stmt->execute($np);
        
        echo"<center>User Was Added Successfully!</center>";
    }
    
}


function displayUsers()
{
     $conn = getDatabaseConnection();
      $sql = "SELECT *
              FROM users
              ORDER BY userId";
              
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $records;
}


function displayWishList()
{
    $conn = getDatabaseConnection();
    $sql = "SELECT *
            FROM wishlist
            ORDER BY wishUser";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $records;
}


function addWishlist()
{
    $conn = getDatabaseConnection();
    function getwishlist()
    {
        global $conn;
        $sql = "SELECT *
                FROM wishlist
                ORDER BY wishUser";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    if(isset($_GET['addWish']))// The addUser form has been pressed
    {
        $sql = "INSERT INTO wishlist(wishName,wishPrice,description,wishUser)
                VALUES(:wishName,:wishPrice,:description,:wishUser)";
        $np = array();
        
        $np[':wishName'] = $_GET['wishName'];
        $np[':wishPrice'] = $_GET['wishPrice'];
        $np[':description'] = $_GET['description'];
        $np[':wishUser'] = $_GET['wishUser'];
        
        $stmt=$conn->prepare($sql);
        $stmt->execute($np);
        
        echo"<center>Wishlist Updated!</center>";
    }    
}


?>