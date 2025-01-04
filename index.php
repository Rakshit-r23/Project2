<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result Management</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f8fc;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007BFF;
            color: white;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 2.5em;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 20px 0 0 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            font-size: 1.2em;
            color: white;
            padding: 10px 15px;
            background-color: #0056b3;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #00408a;
        }

        main {
            padding: 50px;
            text-align: center;
        }

        main section {
            margin: 20px auto;
            max-width: 600px;
        }

        main section h2 {
            color: #0056b3;
        }

        main section p {
            font-size: 1.1em;
            color: #444;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #f4f4f4;
            border-top: 1px solid #ddd;
            color: #666;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Student Result Management System</h1>
        <nav>
            <ul>
                <li><a href="login.php?role=student">Student Login</a></li>
                <li><a href="login.php?role=teacher">Teacher Login</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2>Welcome to the Student Result Management System</h2>
            <p>This platform allows students to view their results and teachers to manage student records and results efficiently.</p>
        </section>
    </main>
    <footer>
        &copy; <?php echo date('Y'); ?> Scholaris | All Rights Reserved
    </footer>
</body>
</html>
