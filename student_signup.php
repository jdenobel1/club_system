<?php
require 'db.php';

// Handle form submission
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $club_id = $_POST['club_id'];
    $session_date = $_POST['session_date'];

    // Check if student has tutoring assigned for that date
    $stmt = $pdo->prepare("SELECT * FROM tutoring_assignments WHERE student_id = ? AND session_date = ?");
    $stmt->execute([$student_id, $session_date]);
    $tutoring = $stmt->fetch();

    if ($tutoring) {
        $message = "You have a tutoring session on this date. You cannot sign up for a club.";
    } else {
        // Check if already signed up
        $stmt = $pdo->prepare("SELECT * FROM club_signups WHERE student_id = ? AND session_date = ?");
        $stmt->execute([$student_id, $session_date]);
        $existing = $stmt->fetch();

        if ($existing) {
            $message = "You already signed up for a club on this date.";
        } else {
            // Insert signup
            $stmt = $pdo->prepare("INSERT INTO club_signups (student_id, club_id, session_date) VALUES (?, ?, ?)");
            $stmt->execute([$student_id, $club_id, $session_date]);
            $message = "Signup successful!";
        }
    }
}

// Fetch clubs for dropdown
$clubs = $pdo->query("SELECT * FROM clubs")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Club Signup</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="p-4">

<div class="container">
    <h2 class="mb-4">Student Club Sign-Up</h2>

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
            <label>Select Club</label>
            <select name="club_id" class="form-control" required>
                <?php foreach ($clubs as $club): ?>
                    <option value="<?= $club['id'] ?>"><?= htmlspecialchars($club['club_name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
</div>

</body>
</html>
