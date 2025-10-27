<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Check if login form was submitted
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['logged_in'] = true;
    } else {
        header('Location: login.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Data Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Patient Diet Determining Software</h1>
        <p>Enter patient information to determine diet plan</p>
        <p>Welcome, <?php echo $_SESSION['username'] ?? 'User'; ?>!</p>
    </header>

    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="reports.php">Reports</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <main>
        <section>
            <h2>Patient Information Form</h2>
            <form action="diet_logic.php" method="post">
                <div class="form-group">
                    <label for="patient_name">Patient Name *</label>
                    <input type="text" id="patient_name" name="patient_name" required>
                </div>
                
                <div class="form-group">
                    <label for="age">Age *</label>
                    <input type="number" id="age" name="age" min="1" max="120" required>
                </div>
                
                <div class="form-group">
                    <label for="weight">Weight (kg) *</label>
                    <input type="number" id="weight" name="weight" step="0.1" required>
                </div>
                
                <div class="form-group">
                    <label for="diagnosis">Diagnosis/Disease *</label>
                    <select id="diagnosis" name="diagnosis" required>
                        <option value="">Select diagnosis</option>
                        <option value="diabetes">Diabetes</option>
                        <option value="hypertension">Hypertension</option>
                        <option value="heart_disease">Heart Disease</option>
                        <option value="obesity">Obesity</option>
                        <option value="kidney_disease">Kidney Disease</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="allergies">Allergies</label>
                    <textarea id="allergies" name="allergies" rows="3" placeholder="List any food allergies"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="medical_history">Medical History</label>
                    <textarea id="medical_history" name="medical_history" rows="3" placeholder="Brief medical history"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="lifestyle">Lifestyle</label>
                    <select id="lifestyle" name="lifestyle">
                        <option value="sedentary">Sedentary</option>
                        <option value="lightly_active">Lightly Active</option>
                        <option value="moderately_active">Moderately Active</option>
                        <option value="very_active">Very Active</option>
                    </select>
                </div>
                
                <button type="submit">Generate Diet Plan</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Chitungwiza Central Hospital - Diet System 2.0</p>
    </footer>
</body>
</html>
