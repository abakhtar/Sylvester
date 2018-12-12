<?php  
session_start();
require('connect.php');
//if the form is submitted...
if (isset($_POST) & !empty($_POST])){
    //assigning posted values to variables.
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = md5($_POST['password']); // password secured with md5 hashing
    //checking to see if the values exist in the db
    $query = "SELECT * FROM `user` WHERE ";
    if(filter_var($username, FILTER_VALIDATE_EMAIL)){
        $sql .= "email='$username'";
    }else{
        $sql .= "username='$username'";
    }
    $sql .= " AND password='$password' AND active=1";
    $sql;
    $res = mysqli_query($connection, $sql);
    $count = mysqli_num_rows($res);
    //after passing check, a new session will be created for the user.
    if ($count == 1){
        $_SESSION['username'] = $username;
        header('location: members/index.php');
    }else{
    //error message if mismatch
        $fmsg = "User does not exist or wrong password";
    }
}

//user is greeted if they are logged in
if (isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    echo "Hi " . $username . "
";
echo "Welcome
";
echo "<a href='logout.php'>Logout</a>";

}else{
 
?>
<html>
<head>
    <title>User Login</title>

<!-- CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

<link rel="stylesheet" href="styles.css" >

<!-- JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
      <form class="form-signin" method="POST">
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
        <h2 class="form-signin-heading">Please Login</h2>
        <div class="input-group">
      <span class="input-group-addon" id="basic-addon1">@</span>
      <input type="text" name="username" class="form-control" placeholder="Username" required>
    </div>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        <a class="btn btn-lg btn-primary btn-block" href="register.php">Register</a>
      </form>
</div>

</body>

</html>
<?php } ?>
