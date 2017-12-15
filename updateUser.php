<?php
session_start();
if(!isset($_SESSION['fullName']))// if(!isset($_SESSION['userName']) || !isset($_SESSION['adminName']))
{
    header("Location: login.php");
}

include'db.php';
$conn = getDatabaseConnection();
function getUserInfo() {
    global $conn;
    
    $sql = "SELECT * 
            FROM users
            WHERE userId = " . $_GET['userId']; 
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $record;

}
    if(isset($_GET['updateUser'])){// checks whether admin has submitted form
    $conn = getDatabaseConnection();
    echo "Form has been submitted!";
    $sql = "UPDATE users
            SET firstName = :firstName,
                lastName = :lastName,
                username = :username,
                password = :password
            WHERE userId = :userId";
    $np = array();
    $np[':userId'] = $_GET['userId'];
    $np[':firstName'] = $_GET['firstName'];
    $np[':lastName'] = $_GET['lastName'];
    $np[':username'] = $_GET['username'];
    $np[':password'] = $_GET['password'];
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    
    
    
    echo"Record has been updated!";
    header("Location: index.php");
    
}
if(isset($_GET['userId'])){
    $userInfo = getUserInfo();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Update Wishlist</title>
        <!--Needed for Bootstrap,Jquery,Javascript,and Ajax-->
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="styles.css">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://fonts.googleapis.com/css?family=Fugaz+One" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
    <!--Navigation Bar-->
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Secret Santa</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="main.html">Home</a></li>
          <li><a href="list.php">User List</a></li>
          <li><a href="wishlist.php">Wishlist</a></li>
          <li><a href="add.php">Add to Wishlist</a></li>
          <?php
          if(isset($_SESSION['admin']))
          {
          echo'<li><a href="admin.php">Update/Delete</a></li>';
          echo'<li><a href="index.php">Delete User</a></li>';
          }
          ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <!--<li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
          <li><a href="login.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
      </div>
    </nav>
    <!--Navigation Bar End-->
    <h3><?php echo $_GET['firstName']?></h3>
    <form method="GET">
        <!-- REGISTRATION FORM -->
        <div class="text-center" style="padding:50px 0">
        	<div class="signup">Update Wishlist</div>
        	<!-- Main Form -->
        	<div class="login-form-1">
        		<form id="register-form" class="text-left">
        			<div class="login-form-main-message"></div>
        			<div class="main-login-form">
        				<div class="login-group">
        					<div class="form-group"> <!--first name-->
        						<label for="reg_username" class="sr-only"></label>
        						<input type="hidden" name="wishId" value="<?=$userInfo['userId']?>"/>
        						<input type="text" class="form-control" id="reg_username" name="firstName" value="<?=$userInfo['firstName']?>" placeholder="First Name">
        					</div>
        					<div class="form-group">    <!--last name-->
        						<label for="reg_password" class="sr-only">Password</label>
        						<input type="text" class="form-control" id="reg_password" name="lastName" value="<?=$userInfo['lastName']?>" placeholder="Last Name">
        					</div>
        					<div class="form-group">    <!--username-->
        						<label for="reg_password_confirm" class="sr-only">Password Confirm</label>
        						<input type="text" class="form-control" id="reg_password_confirm" name="username" value="<?=$userInfo['username']?>" placeholder="Username">
        					</div>
        					
        					<div class="form-group">    <!--password-->
        						<label for="reg_email" class="sr-only">Email</label>
        						<input type="text" class="form-control" id="reg_email" name="password" value="<?=$userInfo['password']?>" placeholder="Password">
        					</div>
        				</div>
        				<button type="submit" name="updateUser" class="login-button"><i class="fa fa-chevron-right"></i></button>
        			</div>
        		</form>
        	</div>
        	<!-- end:Main Form -->
        </div>
    </form>
    
    </body>
</html>