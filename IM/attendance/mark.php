<?php
require '../includes/db.php';
require '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $status = $_POST['status'];
    $remarks = $_POST['remarks'] ?? '';
    $datetime = "$date $time";

    $stmt = $pdo->prepare("INSERT INTO attendance 
                         (student_id, date, status, remarks) 
                         VALUES (?, ?, ?, ?)");
    $stmt->execute([$student_id, $datetime, $status, $remarks]);
    
    header("Location: view.php?success=Attendance+recorded+successfully");
    exit;
}

$students = $pdo->query("SELECT * FROM students ORDER BY last_name, first_name")->fetchAll();
?>

<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h2 class="h4 mb-0">Mark Attendance</h2>
    </div>
    <div class="card-body">
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Select Student</label>
                <select class="form-select" name="student_id" required>
                    <?php foreach ($students as $student): ?>
                        <option value="<?= $student['id'] ?>">
                            <?= htmlspecialchars($student['student_id']) ?> - 
                            <?= htmlspecialchars($student['last_name']) ?>, 
                            <?= htmlspecialchars($student['first_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Date</label>
                    <input type="date" class="form-control" name="date" value="<?= date('Y-m-d') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Time</label>
                    <input type="time" class="form-control" name="time" value="<?= date('H:i') ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select class="form-select" name="status" required>
                    <option value="Present">Present</option>
                    <option value="Absent">Absent</option>
                    <option value="Late">Late</option>
                    <option value="Excused">Excused</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Remarks</label>
                <textarea class="form-control" name="remarks" rows="2" placeholder="Optional remarks"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Submit Attendance
            </button>
        </form>
    </div>
</div>

<?php require '../includes/footer.php'; ?>