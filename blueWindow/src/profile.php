<?php
include('header.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


$mysqli = new mysqli("localhost", "root", "", "blue_window");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


$user_id = $_SESSION['user_id'];
$result = $mysqli->query("SELECT * FROM users WHERE user_id='$user_id'");

if ($result->num_rows === 0) {
    echo "User not found";
    die();
}

$user = $result->fetch_assoc();

?>

<main>
    <section>
        <div class="container d-flex flex-wrap">


            <div class="col-lg-4 col-md-12 pb-3">
                <h3>Profile</h3>
               <div class="user-image pb-3">
                   <?php if (!empty($user['profile_image'])): ?>
                       <?= "<img src='".htmlspecialchars($user['profile_image'])."' alt='Profile Image'>"; ?>

                   <?php endif; ?>
               </div>
                <div class="user-information">
                    <p class="pb-3">Name: <strong><?= $user['name']; ?></strong></p>
                    <p class="pb-3">Last Name: <strong><?= $user['last_name']; ?></strong></p>
                    <p class="pb-3">Email: <strong><?= $user['email']; ?></strong></p>
                </div>
            </div>


            <div class="col-lg-8 col-md-12 pb-3">
                <h3>Change Password</h3>
                <form method="POST" action="change_password_process.php">
                    <div class="form-group">
                        <label for="current_password">Current Password:</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password:</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_new_password">Confirm New Password:</label>
                        <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </form>
            </div>
        </div>
    </section>
</main>

<?php
include('footer.php');
?>
