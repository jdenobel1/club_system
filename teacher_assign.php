<?php
require 'db.php';
session_start();

// Basic login check (optional security layer)
if (!isset($_SESSION['teacher_logged_in'])) {
    header("Location: login.php");
    exit();
}

$message = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $session_date = $_POST['session_date'];
    $subject = $_POST['subject'];

    // Check if already assigned
    $stmt = $pdo->prepare("SELECT * FROM tutoring_assignments WHERE student_id = ? AND session_date = ?");
    $stmt->execute([$student_id, $session_date]);
    $existing = $stmt->fetch();

    if ($existing) {
        $message = "Student already assigned to tutoring on this date.";
    } else {
        // Insert assignment
        $stmt = $pdo->prepare("INSERT INTO tutoring_assignments (student_id, subject, session_date) VALUES (?, ?, ?)");
        $stmt->execute([$student_id, $subject, $session_date]);
        $message = "Tutoring assignment successful!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher Tutoring Assignment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="p-4">

<div class="container">
    <h2 class="mb-4">Assign Student to Tutoring</h2>

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

        <div class="form-group">
            <label>Subject (Optional)</label>
            <input type="text" name="subject" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Assign Tutoring</button>
    </form>

    <a href="logout.php" class="btn btn-secondary mt-3">Logout</a>
</div>

</body>
</html>
