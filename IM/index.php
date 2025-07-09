<?php
require 'includes/header.php';
require 'includes/db.php';

// Get today's date
$today = date('Y-m-d');

// Count total students
$total_students = $pdo->query("SELECT COUNT(*) FROM students")->fetchColumn();

// Get today's attendance summary
$attendance_summary = $pdo->prepare("
    SELECT status, COUNT(*) as count 
    FROM attendance 
    WHERE DATE(date) = ?
    GROUP BY status
");
$attendance_summary->execute([$today]);
$today_stats = $attendance_summary->fetchAll(PDO::FETCH_KEY_PAIR);

// Calculate totals
$present = $today_stats['Present'] ?? 0;
$late = $today_stats['Late'] ?? 0;
$absent = $today_stats['Absent'] ?? 0;
$total_marked = $present + $late + $absent;
?>

<div class="container my-5">
    <div class="text-center mb-4">
        <!-- Dashboard Logo (Bigger) -->
        <img src="/IM/assets/images/attendify-logo.png" alt="ATTENDiFY" class="mb-3" style="height: 100px;">
        <h1 class="display-4 fw-bold text-primary">Attendify Dashboard</h1>
        <p class="lead text-muted">Smart Attendance Tracking</p>
        
        <!-- Action Buttons -->
        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center mt-4">
            <a href="/IM/students/read.php" class="btn btn-primary btn-lg px-4 gap-3">
                <i class="bi bi-people-fill"></i> Students
            </a>
            <a href="/IM/attendance/mark.php" class="btn btn-success btn-lg px-4">
                <i class="bi bi-check-circle-fill"></i> Mark Attendance
            </a>
            <a href="/IM/attendance/view.php" class="btn btn-info btn-lg px-4">
                <i class="bi bi-list-ul"></i> View Records
            </a>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="h4 mb-4"><i class="bi bi-graph-up"></i> Today's Overview (<?= date('F j, Y') ?>)</h3>
                    
                    <?php if ($total_marked > 0): ?>
                        <div class="row text-center">
                            <div class="col-md-3">
                                <div class="p-3 bg-light rounded">
                                    <h4 class="text-primary"><?= $total_students ?></h4>
                                    <p class="mb-0 text-muted">Total Student(s)</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 bg-light rounded">
                                    <h4 class="text-success"><?= $present ?></h4>
                                    <p class="mb-0 text-muted">Present</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 bg-light rounded">
                                    <h4 class="text-warning"><?= $late ?></h4>
                                    <p class="mb-0 text-muted">Late</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 bg-light rounded">
                                    <h4 class="text-danger"><?= ($total_students - $total_marked) ?></h4>
                                    <p class="mb-0 text-muted">Not Marked</p>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle-fill"></i> No attendance marked yet today. 
                            <a href="/IM/attendance/mark.php" class="alert-link">Mark attendance now</a>.
                        </div>
                        <div class="row text-center">
                            <div class="col-md-6 offset-md-3">
                                <div class="p-3 bg-light rounded">
                                    <h4 class="text-primary"><?= $total_students ?></h4>
                                    <p class="mb-0 text-muted">Total Student(s)</p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'includes/footer.php'; ?>