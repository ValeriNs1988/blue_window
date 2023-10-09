<?php
$mysqli = new mysqli("localhost", "root", "", "blue_window");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$name = $mysqli->real_escape_string($_POST['name']);
$last_name = $mysqli->real_escape_string($_POST['last_name']);
$email = $mysqli->real_escape_string($_POST['email']);
$password = $mysqli->real_escape_string($_POST['password']);
$confirm_password = $mysqli->real_escape_string($_POST['confirm_password']);  // Get the confirmation password

if ($password !== $confirm_password) {
    echo "Passwords do not match!"; ?>
    <a class="btn btn-success" href="registration">Back to Registration page</a>
    <?php
    die();
}
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

if ($result->num_rows > 0) {
    echo "Email already registered. Try logging in instead."; ?>
    <a class="btn btn-success" href="registration">Back to Registration page</a>
    <?php
    die();
}

$target_dir = "uploads/";
$target_file = null;

if (isset($_FILES["profile_image"]["tmp_name"]) && $_FILES["profile_image"]["tmp_name"] != '') {
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
    if ($check !== false && $_FILES["profile_image"]["size"] <= 5000000 && in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        if (!move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            echo "Sorry, there was an error uploading your file.";
            die();
        }
    } else {
        echo "File is not an image or is too large.";
        die();
    }
}

if ($target_file !== null && !is_dir($target_dir)) {
    echo 'The directory does not exist.';
    die();
} elseif ($target_file !== null && !is_writable($target_dir)) {
    echo 'The directory is not writable.';
    die();
} elseif ($target_file !== null) {
    echo 'The directory is ready for uploads.';
}

$mysqli->query("INSERT INTO users (name, last_name, email, password_hash, profile_image) VALUES ('$name', '$last_name', '$email', '$hashed_password', '$target_file')");

if ($mysqli->error) {
    echo "Error: " . $mysqli->error;
    die();
}

echo "Registration successful!";
header("Location: login");
?>
