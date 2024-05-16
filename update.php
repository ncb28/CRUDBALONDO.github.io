<?php
include 'db.php';

// Get the information based on the id
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    // Execute SQL query to select user information
    $sql = "SELECT * FROM students WHERE student_id = '$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $fname = $row["fname"];
        $mname = $row["mname"];
        $lname = $row["lname"];
        $suffix = $row["suffix"];
        $course = $row["course"];
        $yearsec = $row["yearsec"];
    } else {
        echo "No user found with the given ID.";
        exit();
    }
} else {
    echo "No ID provided.";
    exit(); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $suffix = $_POST['suffix'];
    $course = $_POST['course'];
    $yearsec = $_POST['yearsec'];

    $sql = "UPDATE students SET fname='$fname', mname='$mname', lname='$lname', suffix='$suffix', course='$course', yearsec='$yearsec' WHERE student_id = '$student_id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data updated successfully!');</script>";
    } else {
        echo "Error updating data: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <!-- Add your CSS styles here if needed -->
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <form method="POST">
        Activity<br><br>
        <input type="hidden" name="student_id" value="<?php echo $id ?>"><br>
        First Name:
        <input type="text" name="fname" value="<?php echo $fname ?>"><br><br>
        Middle Name:
        <input type="text" name="mname" value="<?php echo $mname ?>"><br><br>
        Last Name:
        <input type="text" name="lname" value="<?php echo $lname ?>"><br><br>
        Suffix:
        <input type="text" name="suffix" value="<?php echo $suffix ?>"><br><br>
        Course:
        <input type="text" name="course" value="<?php echo $course ?>"><br><br>
        Year and Section:
        <input type="text" name="yearsec" value="<?php echo $yearsec ?>"><br><br>

        <input type="submit" value="Update">
        <a href="index.php"><input type="button" value="Back"></a>
    </form>
</body>
</html>
