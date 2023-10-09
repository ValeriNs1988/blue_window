<?php
include('header.php');


$mysqli = new mysqli("localhost", "root", "", "blue_window");

if($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$stmt = $mysqli->prepare("SELECT * FROM tasks WHERE user_id = ? AND is_complete = 1");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$completedTasks = $stmt->get_result();

$stmt = $mysqli->prepare("SELECT * FROM tasks WHERE user_id = ? AND is_complete = 0");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$incompleteTasks = $stmt->get_result();


require 'db_connection.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM tasks WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);

$tasks = $stmt->fetchAll();



?>

<main>
    <section class="add-task">
       <div class="container">
           <form  action="add_task.php" method="post">
               <h2 class="pb-3">New Task:</h2>
               <div class="d-flex flex-column pb-3">
                   <label for="title">Title:</label>
                   <input type="text" name="title" required>
               </div>

               <dvi class="d-flex flex-column pb-3">
                   <label for="description">Description:</label>
                   <textarea name="description" required></textarea>
               </dvi>

               <div class="task-action d-flex align-items-center justify-content-between">
                   <div class="due-date d-flex flex-column pb-3">
                       <label for="due_date">Due Date:</label>
                       <input type="date" name="due_date" required>
                   </div>

                   <button class="btn btn-primary" type="submit">Add Task</button>
               </div>
           </form>
       </div>
    </section>
    <section class="incomplete-task">
        <div class="container">
            <h2 class="pb-3">Incomplete Task:</h2>
            <?php foreach ($tasks as $task): ?>
                <?php if ($task['is_complete'] == 0): ?>
                <div class="single-incomplete pb-5 mb-5">
                    <div>
                        <h5>Task Title</h5>
                        <p><?= $task['title'] ?></p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">

                        <div>
                            <h5>Task Status</h5>
                            <p><?= $task['is_complete'] ? 'Complete' : 'Incomplete' ?></p>
                        </div>
                        <div>
                            <h5>Task Due Date</h5>
                            <p><?= $task['due_date'] ?></p>
                        </div>
                    </div>
                    <div>
                        <h5>Task Description</h5>
                        <p><?= $task['description'] ?></p>
                    </div>

                    <div>
                        <h5>Task Actions</h5>
                        <div class="task-action d-flex align-items-center justify-content-between">
                            <a class="btn btn-primary" href="edit_task?task_id=<?= $task['id'] ?>">Edit</a>

                            <form method="POST" action="mark_task.php" style="display:inline;">
                                <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                                <input type="hidden" name="is_complete" value="<?= $task['is_complete'] ? '0' : '1' ?>">
                                <input  class="btn btn-success" type="submit" value="<?= $task['is_complete'] ? 'Mark as Incomplete' : 'Mark as Complete' ?>">
                            </form>

                            <form method="post" action="delete_task.php" onsubmit="return confirm('Are you sure you want to delete this task?');">

                                <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                                <input class="btn btn-danger" type="submit" value="Изтрий задачата">
                            </form>
                        </div>
                    </div>

                </div>
            <?php endif; ?>
            <?php endforeach; ?>

        </div>
    </section>

    <section class="completed-tasks">
        <div class="container">
            <h2 class="pb-3">Completed Tasks</h2>
            <div>
                <?php while($task = $completedTasks->fetch_assoc()): ?>
                    <div class="single-completed pb-5 mb-5">
                        <div class="pb-3">
                            <h5>Task Title</h5>
                            <?= htmlspecialchars($task['title']) ?>
                        </div>
                        <div class="pb-3">
                            <h5>Task Description</h5>
                            <?= htmlspecialchars($task['description']) ?>
                        </div>
                        <form method="POST" action="mark_task.php" style="display:inline;">
                            <h5>Task Actions</h5>
                            <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                            <input type="hidden" name="is_complete" value="0">
                            <input class="btn btn-primary" type="submit" value="Mark as Incomplete">
                        </form>
                    </div>

                <?php endwhile; ?>
            </div>
        </div>
    </section>

</main>

<?php
include('footer.php');
?>


