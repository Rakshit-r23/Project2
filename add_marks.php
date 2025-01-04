<?php
session_start(); // Start the session

// Check if the teacher is logged in
if (!isset($_SESSION['teacher_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Marks</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f8fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 600px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
            color: #34495e;
        }

        input, select, button {
            padding: 10px;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #3498db;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Marks</h1>
        <form method="POST" action="add_marks.php">
            <label for="student_id">Student ID:</label>
            <input type="text" id="student_id" name="student_id" placeholder="Enter Student ID" required>

            <label for="subject_name">Subject Name:</label>
            <input type="text" id="subject_name" name="subject_name" placeholder="Enter Subject Name" required>

            <label for="marks">Marks:</label>
            <input type="number" id="marks" name="marks" placeholder="Enter Marks" required>

            <button type="submit" name="submit">Add Marks</button>
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        include 'db.php';

        $student_id = $_POST['student_id'];
        $subject_name = $_POST['subject_name'];
        $marks = $_POST['marks'];
        $teacher_id = $_SESSION['teacher_id']; // Now $_SESSION['teacher_id'] is guaranteed to be set

        try {
            $stmt = $conn->prepare("INSERT INTO marks (student_id, subject_name, marks, teacher_id) VALUES (:student_id, :subject_name, :marks, :teacher_id)");
            $stmt->execute([
                'student_id' => $student_id,
                'subject_name' => $subject_name,
                'marks' => $marks,
                'teacher_id' => $teacher_id,
            ]);

            echo "<script>alert('Marks added successfully!');</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
        }
    }
    ?>
</body>
</html>


