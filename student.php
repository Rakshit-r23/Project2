<?php
session_start();

if (!isset($_SESSION['student_id']) || $_SESSION['role'] != 'student') {
    header('Location: login.php');
    exit();
}

include 'db.php';

$student_id = $_SESSION['student_id'];

// Fetch student name
$stmt = $conn->prepare("SELECT name FROM students WHERE student_id = :student_id");
$stmt->execute(['student_id' => $student_id]);
$student = $stmt->fetch();

$student_name = $student['name'] ?? 'Student';

// Fetch marks
$stmt = $conn->prepare("
    SELECT subject_name, marks 
    FROM marks 
    WHERE student_id = :student_id
");
$stmt->execute(['student_id' => $student_id]);
$marks = $stmt->fetchAll();

// Calculate passed, failed, and total percentage
$passed = $failed = $total_marks = $obtained_marks = 0;

foreach ($marks as $mark) {
    $obtained_marks += $mark['marks'];
    $total_marks += 100; // Assuming total marks for each subject are 100
    if ($mark['marks'] >= 35) {
        $passed++;
    } else {
        $failed++;
    }
}

$percentage = $total_marks > 0 ? ($obtained_marks / $total_marks) * 100 : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
        }

        header {
            background-color: #007BFF;
            color: white;
            padding: 15px;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 2em;
        }

        main {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 20px;
        }

        .content {
            flex: 1;
        }

        .table-container {
            width: 60%;
            margin-right: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background: white;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        table th {
            background-color: #007BFF;
            color: white;
        }

        table tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        table tbody tr:nth-child(even) {
            background-color: #e6f7ff;
        }

        table tbody tr.pass {
            background-color: #d4edda;
        }

        table tbody tr.fail {
            background-color: #f8d7da;
        }

        .chart-container {
            width: 35%;
        }

        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007BFF;
            border: none;
            color: white;
            font-size: 1em;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<header>
    <h1>Welcome, <?php echo htmlspecialchars($student_name); ?>!</h1>
</header>

<main>
    <div class="content table-container">
        <h2>Your Results</h2>
        <table>
            <thead>
                <tr>
                    <th>Subject Name</th>
                    <th>Total Marks</th>
                    <th>Marks Obtained</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($marks as $mark): ?>
                    <tr class="<?php echo $mark['marks'] >= 35 ? 'pass' : 'fail'; ?>">
                        <td><?php echo htmlspecialchars($mark['subject_name']); ?></td>
                        <td>100</td>
                        <td><?php echo $mark['marks']; ?></td>
                        <td><?php echo $mark['marks'] >= 35 ? 'Pass' : 'Fail'; ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="2"><strong>Total Percentage</strong></td>
                    <td colspan="2"><strong><?php echo number_format($percentage, 2); ?>%</strong></td>
                </tr>
            </tbody>
        </table>
        <button onclick="window.location.href='index.php';">Home</button>
    </div>

    <div class="content chart-container">
        <h2>Performance Chart</h2>
        <canvas id="performanceChart" width="400" height="400"></canvas>
    </div>
</main>

<script>
    const ctx = document.getElementById('performanceChart').getContext('2d');
    const performanceChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Passed', 'Failed'],
            datasets: [{
                data: [<?php echo $passed; ?>, <?php echo $failed; ?>],
                backgroundColor: ['#28a745', '#dc3545']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });
</script>

</body>
</html>
