<?php
session_start();
include("../config/config.php");

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

// Delete Notice
if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    mysqli_query($conn, "DELETE FROM notices WHERE notice_id='$id'");
    header("Location: notices.php");
    exit();
}

// Add Notice
if(isset($_POST['post_notice'])){

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $filename = "";

    if($_FILES['file']['name'] != ""){

        $filename = time() . "_" . $_FILES['file']['name'];

        move_uploaded_file(
            $_FILES['file']['tmp_name'],
            "../uploads/" . $filename
        );

    }

    $date = date("Y-m-d");

    mysqli_query($conn,"
        INSERT INTO notices(title,description,file,posted_date)
        VALUES('$title','$description','$filename','$date')
    ");

    header("Location: notices.php");
    exit();
}

$result = mysqli_query($conn,"SELECT * FROM notices ORDER BY notice_id DESC");
?>

<!DOCTYPE html>
<html>

<head>

    <title>Notice Management</title>

    <link rel="stylesheet" href="../assets/dashboard.css">

</head>

<body>

<div class="container">

    <aside class="sidebar">

        <h2>ShikshyaVerse</h2>

        <ul>

            <li><a href="dashboard.php">Dashboard</a></li>
            <li class="active"><a href="notices.php">Notices</a></li>
            <li><a href="logout.php">Logout</a></li>

        </ul>

    </aside>

    <main class="main">

        <h1>Notice Management</h1>

        <form method="POST" enctype="multipart/form-data">

            <label>Title</label><br>
            <input type="text" name="title" required><br><br>

            <label>Description</label><br>
            <textarea name="description" rows="5"></textarea><br><br>

            <label>Attach File (Optional)</label><br>
            <input type="file" name="file"><br><br>

            <button type="submit" name="post_notice">
                Post Notice
            </button>

        </form>

        <hr><br>

        <h2>All Notices</h2>

        <table border="1" cellpadding="10">

            <tr>

                <th>Title</th>
                <th>Description</th>
                <th>File</th>
                <th>Date</th>
                <th>Action</th>

            </tr>

            <?php while($row=mysqli_fetch_assoc($result)){ ?>

            <tr>

                <td><?php echo $row['title']; ?></td>

                <td><?php echo $row['description']; ?></td>

                <td>

                    <?php
                    if($row['file']!=""){
                    ?>

                    <a href="../uploads/<?php echo $row['file']; ?>" target="_blank">
                        View File
                    </a>

                    <?php
                    }else{
                        echo "No File";
                    }
                    ?>

                </td>

                <td><?php echo $row['posted_date']; ?></td>

                <td>

                    <a href="notices.php?delete=<?php echo $row['notice_id']; ?>"
                    onclick="return confirm('Delete this notice?')">

                    Delete

                    </a>

                </td>

            </tr>

            <?php } ?>

        </table>

    </main>

</div>

</body>
</html>