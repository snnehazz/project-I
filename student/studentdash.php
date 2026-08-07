<?php
session_start();

if(!isset($_SESSION['student'])){
    header("Location: ../login.php");
    exit();
}

include("../config/config.php");

$username = $_SESSION['student'];

$query = mysqli_query($conn, "SELECT * FROM students WHERE username='$username'");
$student = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Student Dashboard</title>

<link rel="stylesheet" href="../assets/dashboard.css">

</head>
<body>

<div class="container">

    <!-- Sidebar -->

    <div class="sidebar">

        <h2>ShikshyaVerse</h2>

        <ul>

            <li class="active">
                <a href="dashboard.php">Dashboard</a>
            </li>

            <li>
                <a href="profile.php">My Profile</a>
            </li>

            <li>
                <a href="courses.php">My Courses</a>
            </li>

            <li>
                <a href="results.php">Results</a>
            </li>

            <li>
                <a href="attendance.php">Attendance</a>
            </li>

            <li>
                <a href="notices.php">Notices</a>
            </li>

            <li>
                <a href="../logout.php">Logout</a>
            </li>

        </ul>

    </div>

    <!-- Main -->

    <div class="main">

        <header>

            <h1>Welcome, <?php echo $student['student_name']; ?></h1>

            <p>Student Dashboard</p>

        </header>

        <!-- Cards -->

        <div class="cards">

            <div class="card">
                <h2><?php echo $student['course']; ?></h2>
                <p>Course</p>
            </div>

            <div class="card">
                <h2>0</h2>
                <p>Subjects</p>
            </div>

            <div class="card">
                <h2>0%</h2>
                <p>Attendance</p>
            </div>

            <div class="card">
                <h2>0</h2>
                <p>New Notices</p>
            </div>

        </div>

        <!-- Student Information -->

        <div class="box">

            <h2>My Information</h2>

            <table>

                <tr>
                    <th>Name</th>
                    <td><?php echo $student['student_name']; ?></td>
                </tr>

                <tr>
                    <th>Username</th>
                    <td><?php echo $student['username']; ?></td>
                </tr>

                <tr>
                    <th>Course</th>
                    <td><?php echo $student['course']; ?></td>
                </tr>

                <tr>
                    <th>Phone</th>
                    <td><?php echo $student['phone']; ?></td>
                </tr>

            </table>

        </div>

    </div>

</div>

</body>
</html>