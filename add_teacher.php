<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Teacher</title>
</head>
<body>
    <h1>Add a Teacher</h1>
    <form method="POST" action="add_teacher.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit" name="add_teacher">Add Teacher</button>
    </form>
</body>
</html>
<?php
include 'db.php';

if (isset($_POST['add_teacher'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Encrypt the password

    $stmt = $conn->prepare("
        INSERT INTO teachers (username, password) 
        VALUES (:username, :password)
    ");
    $stmt->execute([
        'username' => $username,
        'password' => $password
    ]);

    echo "Teacher added successfully!";
}
?>
