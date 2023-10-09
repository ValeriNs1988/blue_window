<?php
include('header.php');
?>

<main>
    <section>
        <div class="container mt-3">
            <h2>Login</h2>
            <form method="POST" action="login_process.php">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </section>
</main>

<?php
include('footer.php');
?>
