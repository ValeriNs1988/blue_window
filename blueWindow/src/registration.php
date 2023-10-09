<?php
include('header.php');
?>

<main>
    <section>
        <div class="container mt-3">
            <h2>Registration</h2>
            <form method="POST" action="register_process.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="profile_image">Profile Image:</label>
                    <input type="file" class="form-control" id="profile_image" name="profile_image" accept=".jpg, .jpeg, .png, .gif">
                </div>

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Verify Password:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </section>
</main>

<?php
include('footer.php');
?>
