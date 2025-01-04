<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
</head>
<body>
    <h1>Add a Student</h1>
    <form method="POST" action="add_student.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <button type="submit" name="add_student">Add Student</button>
    </form>
</body>
</html>
<?php
include 'db.php'; // Include your database connection

if (isset($_POST['add_student'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Encrypt the password
    $name = $_POST['name'];

    $stmt = $conn->prepare("
        INSERT INTO students (username, password, name) 
        VALUES (:username, :password, :name)
    ");
    $stmt->execute([
        'username' => $username,
        'password' => $password,
        'name' => $name
    ]);

    echo "Student added successfully!";
}
?>
