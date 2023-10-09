<?php
include ('header.php');

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['task_id'])) {
    header("Location: dashboard.php");
    exit;
}

$task_id = $_GET['task_id'];

$mysqli = new mysqli("localhost", "root", "", "blue_window");

if($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$stmt = $mysqli->prepare("SELECT * FROM tasks WHERE id = ?");
$stmt->bind_param("i", $task_id);

$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0) {
    $task = $result->fetch_assoc();
} else {
    echo "No task found";
    exit;
}

$stmt->close();
$mysqli->close();
?>


<main>
    <section class="edit-task">
        <div class="container">
            <h2>Edit Task</h2>

            <form class="d-flex flex-column" action="update_task.php" method="POST">
                <div class="d-flex flex-column pb-3">
                    <input type="hidden" name="task_id" value="<?php echo htmlspecialchars($task['id']); ?>">

                    <label for="title">Edit Title:</label>
                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>
                </div>


               <div class="d-flex flex-column pb-3">
                   <label for="description">Edit Description:</label>
                   <textarea id="description" name="description" required><?php echo htmlspecialchars($task['description']); ?></textarea>
               </div>


                <div class="task-action d-flex align-items-center justify-content-between">
                    <div class="d-flex flex-column pb-3">
                        <label for="due_date">Edit Due Date:</label>
                        <input type="date" id="due_date" name="due_date" value="<?php echo htmlspecialchars($task['due_date']); ?>" required>


                    </div>
                    <div>
                        <input class="btn btn-primary" type="submit" value="Update Task">
                    </div>
                </div>



            </form>

            <a class="btn btn-success mb-5 mt-5" href="dashboard">Back to Dashboard</a>
        </div>
    </section>
</main>

<?php
include ('footer.php');
?>