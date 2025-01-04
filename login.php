<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Encrypt password as per your database format

    // Check if the user is a teacher
    $stmtTeacher = $conn->prepare("SELECT * FROM teachers WHERE teacher_id = :teacher_id AND password = :password");
    $stmtTeacher->execute(['teacher_id' => $username, 'password' => $password]);
    $teacher = $stmtTeacher->fetch();

    if ($teacher) {
        // Teacher login successful
        $_SESSION['teacher_id'] = $teacher['teacher_id'];
        $_SESSION['username'] = $teacher['username'];
        $_SESSION['role'] = 'teacher';
        header('Location: teacher.php');
        exit();
    }

    // Check if the user is a student
    $stmtStudent = $conn->prepare("SELECT * FROM students WHERE username = :username AND password = :password");
    $stmtStudent->execute(['username' => $username, 'password' => $password]);
    $student = $stmtStudent->fetch();

    if ($student) {
        // Student login successful
        $_SESSION['student_id'] = $student['student_id'];
        $_SESSION['username'] = $student['name']; // Assuming 'name' holds the student's name
        $_SESSION['role'] = 'student';
        header('Location: student.php');
        exit();
    }

    // If no match is found, display an error
    echo "Invalid credentials.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-box {
            width: 400px;
            padding: 30px 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-weight: bold;
        }

        .login-box form {
            display: flex;
            flex-direction: column;
        }

        .login-box input {
            width: calc(100% - 20px); /* Adjust width to leave space for padding */
            padding: 12px 15px;
            margin: 10px auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }

        .login-box input:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .login-box button {
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            width: calc(100% - 20px); /* Match input width */
            margin: 10px auto;
        }

        .login-box button:hover {
            background-color: #0056b3;
        }

        .login-box p {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
            color: #777;
        }

        .login-box p a {
            color: #007bff;
            text-decoration: none;
        }

        .login-box p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Enter Username or Teacher ID" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Forgot your password? <a href="#">Reset it here</a></p>
    </div>
</body>
</html>
