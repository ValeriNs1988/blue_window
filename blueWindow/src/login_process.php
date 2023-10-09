<?php
session_start();


$mysqli = new mysqli("localhost", "root", "", "blue_window");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$email = $mysqli->real_escape_string($_POST['email']);
$password = $mysqli->real_escape_string($_POST['password']);

$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

if ($result->num_rows === 0):
    echo "No such user found";?>
   <a class="btn btn-success" href="login">Back to Login page</a>
  <?php
    die();
    ?>
<?php endif;


$user = $result->fetch_assoc();

if (!password_verify($password, $user['password_hash'])):
    echo "Password is incorrect"; ?>
   <a class="btn btn-success" href="login">Back to Login page</a>
  <?php
    die();
    ?>
<?php endif;

$_SESSION['user_id'] = $user['user_id'];
$_SESSION['user_name'] = $user['name'];

header("Location: index");

?>


