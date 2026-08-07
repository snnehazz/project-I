<?php
session_start();
include("../config/config.php");

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

$student=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM user WHERE role_id=2"));
$teacher=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM user WHERE role_id=3"));
$course=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM course"));
$subject=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM subject"));
$notice=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM notice"));

$id=(int)$_SESSION['admin'];
$admin=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM user WHERE id=$id"));

if(!$admin){
    session_destroy();
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="../assets/dashboard.css">
</head>

<body>

<div class="container">

    <div class="sidebar">
        <h2>ShikshyaVerse</h2>

        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="students.php">Students</a></li>
            <li><a href="teachers.php">Teachers</a></li>
            <li><a href="courses.php">Courses</a></li>
            <li><a href="subjects.php">Subjects</a></li>
            <li><a href="course_subject.php">Course Subjects</a></li>
            <li><a href="student_fee.php">Student Fees</a></li>
            <li><a href="notices.php">Notices</a></li>
            <li><a href="marks.php">Marks</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="content">

        <h1>Welcome, <?php echo htmlspecialchars($admin['name']); ?></h1>

        <div class="cards">

            <div class="card">
                <h3>Students</h3>
                <p><?php echo $student['total']; ?></p>
            </div>

            <div class="card">
                <h3>Teachers</h3>
                <p><?php echo $teacher['total']; ?></p>
            </div>

            <div class="card">
                <h3>Courses</h3>
                <p><?php echo $course['total']; ?></p>
            </div>

            <div class="card">
                <h3>Subjects</h3>
                <p><?php echo $subject['total']; ?></p>
            </div>

            <div class="card">
                <h3>Notices</h3>
                <p><?php echo $notice['total']; ?></p>
            </div>

        </div>

    </div>

</div>

</body>
</html>