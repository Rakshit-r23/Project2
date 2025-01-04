<?php
session_start();

// Check if the teacher is logged in
if (!isset($_SESSION['teacher_id']) || $_SESSION['role'] != 'teacher') {
    header('Location: login.php');
    exit();
}

// Get the teacher's username from the session
$username = $_SESSION['username']; // Assuming 'username' is set in the session during login
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            color: #333;
            line-height: 1.6;
        }

        /* Header */
        .header {
            background-color: #007BFF;
            color: #fff;
            padding: 1.5rem;
            text-align: center;
            font-size: 1.8rem;
        }

        /* Container */
        .container {
            display: flex;
            height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 20%;
            background-color: #343a40;
            color: #fff;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li {
            margin: 1rem 0;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 1.2rem;
            display: block;
            padding: 0.5rem;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: #007BFF;
            color: #fff;
        }

        /* Main Content */
        .main-content {
            width: 80%;
            padding: 2rem;
            background-color: #fff;
            overflow-y: auto;
        }

        .main-content h2 {
            margin-bottom: 1rem;
            color: #007BFF;
        }

        .main-content p {
            font-size: 1.1rem;
            color: #555;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
    </header>
    <main class="container">
    <nav class="sidebar">
    <ul>
        <li><a href="add_marks.php">Add Marks</a></li>
        <li><a href="timetable.php">View Timetable</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>

        <section class="main-content">
            <h2>Teacher Panel</h2>
            <p>Select an option from the menu to manage students or marks.</p>
        </section>
    </main>
</body>
</html>
