<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$mysqli = new mysqli("localhost", "root", "", "blue_window");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_POST['new_password'] !== $_POST['confirm_new_password'] || empty($_POST['new_password'])) {
    echo "Passwords do not match or are empty";?>
    <a class="btn btn-success" href="profile">Back to Profile page</a>
    <?php
    die();
}

$user_id = $_SESSION['user_id'];
$result = $mysqli->query("SELECT * FROM users WHERE user_id='$user_id'");

if ($result->num_rows === 0) {
    echo "User not found";
    die();
}

$user = $result->fetch_assoc();

if (!password_verify($_POST['current_password'], $user['password_hash'])) {
    echo "Current password is incorrect";?>
    <a class="btn btn-success" href="profile">Back to Profile page</a>
    <?php
    die();
}

$new_password_hash = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
$mysqli->query("UPDATE users SET password_hash='$new_password_hash' WHERE user_id='$user_id'");

if ($mysqli->error) {
    echo "Error: " . $mysqli->error;
    die();
}

header('Location: profile.php?passwordChanged=true');
?>
