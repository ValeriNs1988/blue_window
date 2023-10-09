<?php
include ('header.php');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task_id']) && isset($_POST['is_complete'])) {
    $task_id = $_POST['task_id'];
    $is_complete = $_POST['is_complete'] ? 1 : 0;

    $mysqli = new mysqli("localhost", "root", "", "blue_window");

    if($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $stmt = $mysqli->prepare("UPDATE tasks SET is_complete = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("iii", $is_complete, $task_id, $_SESSION['user_id']);

    if($stmt->execute()) {
        header("Location: dashboard");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();



}

?>


