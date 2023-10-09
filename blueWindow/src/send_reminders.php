<?php
$mysqli = new mysqli("localhost", "root", "", "blue_window");
if($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$stmt = $mysqli->prepare("SELECT * FROM tasks WHERE reminder_datetime BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 1 MINUTE)");
$stmt->execute();
$reminders = $stmt->get_result();

while ($task = $reminders->fetch_assoc()) {

}

$stmt->close();
$mysqli->close();
?>
