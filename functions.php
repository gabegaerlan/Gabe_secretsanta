<?php
session_start();
include './db.php';


function loginProcess() 
{
    $conn = getDatabaseConnection();
    if (isset($_POST['login']))// check if <form> is pressed 
    {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
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
            $_SESSION['userID'] = $record['userID'];
        
            header("Location: list.php");
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
        
            header("Location: list.php");
        }
    }
}

function signup()
{
    $conn = getDatabaseConnection();
    // TODO Is this used as well?
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

        $hashPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users(firstName,lastName,username,password)
                VALUES(:firstName,:lastName,:username,$hashPassword)";
        $np = array();
        
        $np[':firstName'] = $_GET['firstName'];
        $np[':lastName'] = $_GET['lastName'];
        $np[':username'] = $_GET['username'];
        $np[':password'] = $hashPassword;
        
        $stmt=$conn->prepare($sql);
        $stmt->execute($np);
        
        echo"<center>User Was Added Successfully!</center>";
    }
    
}


function displayUsers()
{
     $conn = getDatabaseConnection();
      $sql = "SELECT firstName, lastName, username
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
    // TODO: Fix this
//    $sql = "SELECT users.firstName, wishlistusers.wishName, wishlistusers.description, wishlistusers.wishPrice
//                FROM wishlistusers INNER JOIN users ON users.userID = wishlistusers.userID;";
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

    // TODO: Does this do nothing?
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
        $userID = $_SESSION['userID'];

//        $sql = "INSERT INTO wishlistusers(userID, wishName,wishPrice,description,wishUser)
//                VALUES($userID,:wishName,:wishPrice,:description,:wishUser)";
        $sql = "INSERT INTO wishlist(wishName,wishPrice,description,wishUser)
                VALUES(:wishName,:wishPrice,:description,:wishUser)";
        $np = array();

//        $np[':userID'] = $_GET['userID'];
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