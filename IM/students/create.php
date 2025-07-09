<?php
require '../includes/db.php';
require '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $year_level = $_POST['year_level'];
    $program = $_POST['program'];
    $section = $_POST['section'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO students 
                             (student_id, first_name, last_name, year_level, program, section, email, phone) 
                             VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$student_id, $first_name, $last_name, $year_level, $program, $section, $email, $phone]);
        
        header("Location: read.php?success=Student+added+successfully");
        exit;
    } catch (PDOException $e) {
        $error = "Error adding student: " . $e->getMessage();
    }
}
?>

<div class="card shadow-lg border-0">
    <div class="card-header bg-primary text-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0"><i class="bi bi-person-plus me-2"></i>Add New Student</h2>
            <a href="read.php" class="btn btn-light btn-sm">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
    <div class="card-body">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger mb-4">
                <i class="bi bi-exclamation-triangle-fill me-2"></i><?= $error ?>
            </div>
        <?php endif; ?>

        <form method="post" class="row g-4">
            <!-- Student ID -->
            <div class="col-md-6">
                <label for="student_id" class="form-label">Student ID <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-id-card"></i></span>
                    <input type="text" class="form-control" id="student_id" name="student_id" required>
                </div>
            </div>

            <!-- Empty column for alignment -->
            <div class="col-md-6"></div>

            <!-- Name Fields - Side by Side -->
            <div class="col-md-6">
                <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-person-fill"></i></span>
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>
            </div>

            <div class="col-md-6">
                <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-person-fill"></i></span>
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>
            </div>

            <!-- Academic Info -->
            <div class="col-md-6">
                <label for="year_level" class="form-label">Year Level <span class="text-danger">*</span></label>
                <select class="form-select" id="year_level" name="year_level" required>
                    <option value="" disabled selected>Select year level...</option>
                    <option value="1st Year">1st Year</option>
                    <option value="2nd Year">2nd Year</option>
                    <option value="3rd Year">3rd Year</option>
                    <option value="4th Year">4th Year</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="program" class="form-label">Program <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-book"></i></span>
                    <input type="text" class="form-control" id="program" name="program" required>
                </div>
            </div>

            <div class="col-md-6">
                <label for="section" class="form-label">Section <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-people"></i></span>
                    <input type="text" class="form-control" id="section" name="section" required>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
            </div>

            <div class="col-md-6">
                <label for="phone" class="form-label">Phone</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-phone"></i></span>
                    <input type="tel" class="form-control" id="phone" name="phone">
                </div>
            </div>

            <!-- Submit Button -->
            <div class="col-12 mt-2">
                <button type="submit" class="btn btn-primary py-2 px-4">
                    <i class="bi bi-save-fill me-2"></i>Save Student
                </button>
            </div>
        </form>
    </div>
    <div class="card-footer bg-light">
        <small class="text-muted"><span class="text-danger">*</span> indicates required field</small>
    </div>
</div>

<?php require '../includes/footer.php'; ?>