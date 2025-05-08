<?php
require 'db.php';
session_start();

$message = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $session_date = $_POST['session_date'];

    // Check if student is signed up for club OR assigned to tutoring on this date
    $stmt = $pdo->prepare("
        SELECT 'club' AS type FROM club_signups WHERE student_id = ? AND session_date = ?
        UNION
        SELECT 'tutoring' AS type FROM tutoring_assignments WHERE student_id = ? AND session_date = ?
    ");
    $stmt->execute([$student_id, $session_date, $student_id, $session_date]);
    $result = $stmt->fetch();

    if (!$result) {
        $message = "No valid club or tutoring session found for this date.";
    } else {
        // Check if already checked in
        $stmt = $pdo->prepare("SELECT * FROM attendance WHERE student_id = ? AND session_date = ?");
        $stmt->execute([$student_id, $session_date]);
        $existing = $stmt->fetch();

        if ($existing) {
            $message = "You already checked in.";
        } else {
            // Record attendance
            $stmt = $pdo->prepare("INSERT INTO attendance (student_id, session_date, type) VALUES (?, ?, ?)");
            $stmt->execute([$student_id, $session_date, $result['type']]);
            $message = "Check-in successful!";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Check-In</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="p-4">

<div class="container">
    <h2 class="mb-4">Student Check-In</h2>

    <?php if ($message): ?>
        <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label>Student ID</label>
            <input type="number" name="student_id" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Session Date</label>
            <input type="date" name="session_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Check In</button>
    </form>
</div>

</body>
</html>
