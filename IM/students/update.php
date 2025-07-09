<?php
require '../includes/db.php';
require '../includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: read.php");
    exit;
}

$id = $_GET['id'];
$student = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$student->execute([$id]);
$student = $student->fetch();

if (!$student) {
    header("Location: read.php");
    exit;
}

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
        $stmt = $pdo->prepare("UPDATE students SET 
                              student_id = ?, 
                              first_name = ?, 
                              last_name = ?, 
                              year_level = ?, 
                              program = ?, 
                              section = ?, 
                              email = ?, 
                              phone = ? 
                              WHERE id = ?");
        $stmt->execute([$student_id, $first_name, $last_name, $year_level, $program, $section, $email, $phone, $id]);
        
        header("Location: read.php?success=Student+updated+successfully");
        exit;
    } catch (PDOException $e) {
        $error = "Error updating student: " . $e->getMessage();
    }
}
?>

<h2>Edit Student</h2>
<?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
<form method="post">
    <label>Student ID:</label>
    <input type="text" name="student_id" value="<?= htmlspecialchars($student['student_id']) ?>" required>
    
    <label>First Name:</label>
    <input type="text" name="first_name" value="<?= htmlspecialchars($student['first_name']) ?>" required>
    
    <label>Last Name:</label>
    <input type="text" name="last_name" value="<?= htmlspecialchars($student['last_name']) ?>" required>
    
    <label>Year Level:</label>
    <select name="year_level" required>
        <option value="1st Year" <?= $student['year_level'] == '1st Year' ? 'selected' : '' ?>>1st Year</option>
        <option value="2nd Year" <?= $student['year_level'] == '2nd Year' ? 'selected' : '' ?>>2nd Year</option>
        <option value="3rd Year" <?= $student['year_level'] == '3rd Year' ? 'selected' : '' ?>>3rd Year</option>
        <option value="4th Year" <?= $student['year_level'] == '4th Year' ? 'selected' : '' ?>>4th Year</option>
    </select>
    
    <label>Program:</label>
    <input type="text" name="program" value="<?= htmlspecialchars($student['program']) ?>" required>
    
    <label>Section:</label>
    <input type="text" name="section" value="<?= htmlspecialchars($student['section']) ?>" required>
    
    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($student['email']) ?>">
    
    <label>Phone:</label>
    <input type="tel" name="phone" value="<?= htmlspecialchars($student['phone']) ?>">
    
    <button type="submit">Update Student</button>
</form>

<?php require '../includes/footer.php'; ?>