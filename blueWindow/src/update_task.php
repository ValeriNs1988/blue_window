<?php
include ('header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_id = $_POST['task_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];

    $mysqli = new mysqli("localhost", "root", "", "blue_window");

    if($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $stmt = $mysqli->prepare("UPDATE tasks SET title = ?, description = ?, due_date = ? WHERE id = ?");
    $stmt->bind_param("sssi", $title, $description, $due_date, $task_id);

    if($stmt->execute()) {
        header("Location: dashboard");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}
