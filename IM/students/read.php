<?php
require '../includes/db.php';
require '../includes/header.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: read.php?success=Student+deleted+successfully");
    exit;
}

$students = $pdo->query("SELECT * FROM students ORDER BY last_name, first_name")->fetchAll();
?>

<div class="card shadow">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h2 class="h4 mb-0">Student Records</h2>
        <a href="create.php" class="btn btn-light btn-sm">
            <i class="bi bi-plus-circle"></i> Add New
        </a>
    </div>
    <div class="card-body">
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Year</th>
                        <th>Program</th>
                        <th>Section</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= $student['id'] ?></td>
                        <td><?= htmlspecialchars($student['student_id']) ?></td>
                        <td><?= htmlspecialchars($student['last_name']) ?>, <?= htmlspecialchars($student['first_name']) ?></td>
                        <td><?= htmlspecialchars($student['year_level']) ?></td>
                        <td><?= htmlspecialchars($student['program']) ?></td>
                        <td><?= htmlspecialchars($student['section']) ?></td>
                        <td>
                            <a href="update.php?id=<?= $student['id'] ?>" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <a href="read.php?delete=<?= $student['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this student?')">
                                <i class="bi bi-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require '../includes/footer.php'; ?>