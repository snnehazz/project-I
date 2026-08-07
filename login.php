<?php
session_start();
include("config/config.php");

$error="";

if(isset($_POST['login'])){

    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);

    $query=mysqli_query($conn,"
    SELECT * FROM user
    WHERE username='$username'
    AND password='$password'
    ");

    if(mysqli_num_rows($query)>0){

        $row=mysqli_fetch_assoc($query);

        if($row['role_id']==1){

            $_SESSION['admin']=$row['id'];
            header("Location: admin/dashboard.php");
            exit();

        }

        elseif($row['role_id']==2){

            $_SESSION['student']=$row['id'];
            header("Location: student/dashboard.php");
            exit();

        }

        elseif($row['role_id']==3){

            $_SESSION['teacher']=$row['id'];
            header("Location: teacher/dashboard.php");
            exit();

        }

    }

    else{

        $error="Invalid Username or Password.";

    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>ShikshyaVerse Login</title>

<link rel="stylesheet" href="assets/login.css">

</head>

<body>

<div class="login-box">

    <h1>ShikshyaVerse</h1>

    <p>Student Management System</p>

    <?php
    if($error!=""){
        echo "<div class='error'>$error</div>";
    }
    ?>

    <form method="POST">

        <label>Username</label>

        <input type="text"  name="username"  placeholder="Enter Username" required>

        <label>Password</label>

        <input type="password" name="password"  placeholder="Enter Password"  required>

     <!-- Role, Username, Password --> 

    <button type="submit" name="login"> Login </button>

    </form>

</div>

</body>
</html>