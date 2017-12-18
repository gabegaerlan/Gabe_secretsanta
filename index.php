<?php
session_start();
if(!isset($_SESSION['admin']))// if(!isset($_SESSION['userName']) || !isset($_SESSION['adminName']))
{
    header("Location: login.php");
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
      
        <script language="javascript">
            function confirmDelete() 
                {
                    return confirm("Are you sure?");
                }

        </script>
      
      
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
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
      </div>
    </nav>
    <!--Navigation Bar End-->
    
    <h2><font color="red" face="Fugaz One">Welcome <?=$_SESSION['fullName']?>!</h2></font>
    <?php
      session_start();
      include'./functions.php';
      
      function userList()
      {
        $conn = getDatabaseConnection();
        $sql = "SELECT *
                FROM users
                ORDER BY userId ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $records;
      }
    ?>
    <table align="center" border=2>
    <th><b>ID</b></th>
    <th><b>First name</b></th>
    <th><b>Last Name</b></th>
    <th><b>Username</b></th>
    <th><b>Password</b></th>
    <th><b>Update/Delete</b></th>
    
    <?php
      $display = userList();
      foreach($display as $d)
      {
        echo'<tr>';
        echo'<td>'.$d['userId'].'</td>';
        echo'<td>'.$d['firstName'].'</td>';
        echo'<td>'.$d['lastName'].'</td>';
        echo'<td>'.$d['username'].'</td>';
        echo'<td>'.$d['password'].'</td>';
        echo'<td>'."[<a href='updateUser.php?userId=".$d['userId']."'>Update </a>] "."[<a onclick='return confirmDelete()' href='deleteUser.php?userId=".$d['userId']."'> Delete </a>]".'</td>';   
        echo'</tr>';
      }
      echo'</table>';
    ?>
    </table>
    </body>
</html>