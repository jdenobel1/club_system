<?php
require 'db.php';
session_start();

// Basic login check (optional)
if (!isset($_SESSION['teacher_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Fetch attendance records
$stmt = $pdo->query("SELECT * FROM attendance ORDER BY session_date DESC");
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Attendance Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
</head>
<body class="p-4">

<div class="container">
    <h2 class="mb-4">Admin Attendance Report</h2>

    <table id="attendanceTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student ID</th>
                <th>Session Date</th>
                <th>Type</th>
                <th>Checked In At</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records as $rec): ?>
                <tr>
                    <td><?= $rec['id'] ?></td>
                    <td><?= $rec['student_id'] ?></td>
                    <td><?= $rec['session_date'] ?></td>
                    <td><?= ucfirst($rec['type']) ?></td>
                    <td><?= $rec['checkin_time'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="logout.php" class="btn btn-secondary mt-3">Logout</a>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    $('#attendanceTable').DataTable({
        "order": [[2, "desc"]]
    });
});
</script>

</body>
</html>
