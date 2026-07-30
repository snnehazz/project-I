<?php
session_start();
include("../config/database.php");

/* Uncomment this after you create login
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}
*/

// Count Students
$studentQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM students");
$studentCount = mysqli_fetch_assoc($studentQuery)['total'];

// Count Teachers
$teacherQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM teachers");
$teacherCount = mysqli_fetch_assoc($teacherQuery)['total'];

// Count Courses
$courseQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM courses");
$courseCount = mysqli_fetch_assoc($courseQuery)['total'];

// Count Notices
$noticeQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM notices");
$noticeCount = mysqli_fetch_assoc($noticeQuery)['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Dashboard</title>

<link rel="stylesheet" href="../assets/dashboard.css">

</head>

<body>

<div class="container">

    <!-- Sidebar -->

    <aside class="sidebar">

        <h2>ShikshyaVerse</h2>

        <ul>

            <li class="active">
                <a href="dashboard.php">Dashboard</a>
            </li>

            <li>
                <a href="students.php">Students</a>
            </li>

            <li>
                <a href="teachers.php">Teachers</a>
            </li>

            <li>
                <a href="courses.php">Courses</a>
            </li>

            <li>
                <a href="attendance.php">Attendance</a>
            </li>

            <li>
                <a href="fees.php">Fees</a>
            </li>

            <li>
                <a href="results.php">Results</a>
            </li>

            <li>
                <a href="notices.php">Notices</a>
            </li>

            <li>
                <a href="logout.php">Logout</a>
            </li>

        </ul>

    </aside>

    <!-- Main -->

    <main class="main">

        <header>

            <div>

                <h1>Dashboard</h1>

                <p>Welcome, Admin</p>

            </div>

        </header>

        <!-- Dashboard Cards -->

        <section class="cards">

            <div class="card">

                <h2><?php echo $studentCount; ?></h2>

                <p>Total Students</p>

            </div>

            <div class="card">

                <h2><?php echo $teacherCount; ?></h2>

                <p>Total Teachers</p>

            </div>

            <div class="card">

                <h2><?php echo $courseCount; ?></h2>

                <p>Total Courses</p>

            </div>

            <div class="card">

                <h2><?php echo $noticeCount; ?></h2>

                <p>Total Notices</p>

            </div>

        </section>

        <!-- Quick Actions -->

        <section class="box">

            <h2>Quick Actions</h2>

            <div class="buttons">

                <a href="add_student.php">
                    <button>Add Student</button>
                </a>

                <a href="add_teacher.php">
                    <button>Add Teacher</button>
                </a>

                <a href="add_course.php">
                    <button>Add Course</button>
                </a>

                <a href="add_notice.php">
                    <button>Post Notice</button>
                </a>

            </div>

        </section>

    </main>

</div>

</body>
</html>