<?php
require '../includes/db.php';
require '../includes/header.php';

$records = $pdo->query("
    SELECT a.date, a.status, a.remarks,
           s.student_id, s.last_name, s.first_name
    FROM attendance a
    JOIN students s ON a.student_id = s.id
    ORDER BY a.date DESC
")->fetchAll();
?>

<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h2 class="h4 mb-0">Attendance Records</h2>
    </div>
    <div class="card-body">
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>Date & Time</th>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $record): ?>
                    <tr>
                        <td><?= htmlspecialchars($record['date']) ?></td>
                        <td><?= htmlspecialchars($record['student_id']) ?></td>
                        <td><?= htmlspecialchars($record['last_name']) ?>, <?= htmlspecialchars($record['first_name']) ?></td>
                        <td>
                            <span class="badge 
                                <?= $record['status'] == 'Present' ? 'bg-success' : '' ?>
                                <?= $record['status'] == 'Absent' ? 'bg-danger' : '' ?>
                                <?= $record['status'] == 'Late' ? 'bg-warning text-dark' : '' ?>
                                <?= $record['status'] == 'Excused' ? 'bg-info text-dark' : '' ?>">
                                <?= htmlspecialchars($record['status']) ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($record['remarks']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require '../includes/footer.php'; ?>