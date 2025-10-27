<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Get patient data from URL or session
if (isset($_GET['patient']) && isset($_GET['data'])) {
    $patient_name = $_GET['patient'];
    $patient_data = unserialize(urldecode($_GET['data']));
} elseif (isset($_SESSION['patient_data'])) {
    $patient_data = $_SESSION['patient_data'];
    $patient_name = $patient_data['name'];
} else {
    $patient_name = "Unknown Patient";
    $patient_data = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diet Plan Report</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        @media print {
            nav, .actions, footer { display: none; }
            body { background: white; }
            .report-container { box-shadow: none; }
        }
    </style>
</head>
<body>
    <header>
        <h1>Patient Diet Determining Software</h1>
        <p>Diet Plan Report</p>
    </header>

    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="patient_form.php">New Patient</a></li>
            <li><a href="reports.php">Reports</a></li>
        </ul>
    </nav>

    <main>
        <section class="report-container">
            <h2>Diet Plan Report for <?php echo $patient_name; ?></h2>
            
            <div class="report-section">
                <h3>Patient Information</h3>
                <table>
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td><?php echo $patient_data['name'] ?? 'N/A'; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Age:</strong></td>
                        <td><?php echo $patient_data['age'] ?? 'N/A'; ?> years</td>
                    </tr>
                    <tr>
                        <td><strong>Weight:</strong></td>
                        <td><?php echo $patient_data['weight'] ?? 'N/A'; ?> kg</td>
                    </tr>
                    <tr>
                        <td><strong>BMI:</strong></td>
                        <td><?php echo $patient_data['bmi'] ?? 'N/A'; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Diagnosis:</strong></td>
                        <td><?php echo ucfirst(str_replace('_', ' ', $patient_data['diagnosis'] ?? '')); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Date:</strong></td>
                        <td><?php echo $patient_data['date'] ?? date('Y-m-d H:i:s'); ?></td>
                    </tr>
                </table>
            </div>

            <div class="report-section">
                <h3>Recommended Diet Plan</h3>
                <ul>
                    <?php if (isset($patient_data['diet_plan'])): ?>
                        <?php foreach ($patient_data['diet_plan'] as $recommendation): ?>
                            <li><?php echo $recommendation; ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No diet plan available. Please generate a diet plan first.</li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="report-section">
                <h3>Additional Notes</h3>
                <p>This diet plan is generated based on the patient's diagnosis and general health guidelines. Please consult with a healthcare professional before implementing any dietary changes.</p>
                <p>For personalized advice, consider consulting with a registered dietitian.</p>
            </div>

            <div class="actions">
                <button onclick="window.print()">Print Report</button>
                <a href="patient_form.php"><button>New Patient</button></a>
                <a href="index.html"><button>Home</button></a>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Chitungwiza Central Hospital - Diet System 2.0</p>
    </footer>

    <script>
        // Function to download report as text file
        function downloadReport() {
            const reportContent = document.querySelector('.report-container').innerText;
            const blob = new Blob([reportContent], { type: 'text/plain' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'diet_report_<?php echo $patient_name; ?>.txt';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }
    </script>
</body>
</html>
