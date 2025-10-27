<?php
// diet_logic.php - Handles diet determination based on patient data

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_name = $_POST['patient_name'];
    $age = $_POST['age'];
    $weight = $_POST['weight'];
    $diagnosis = $_POST['diagnosis'];
    $allergies = $_POST['allergies'];
    $medical_history = $_POST['medical_history'];
    $lifestyle = $_POST['lifestyle'];

    // Calculate BMI
    $height_m = 1.75; // Assuming average height, in a real system this would be input
    $bmi = $weight / ($height_m * $height_m);

    // Determine diet plan based on diagnosis
    $diet_plan = determine_diet_plan($diagnosis, $bmi, $age, $allergies);

    // Store patient data (in a real system, this would go to a database)
    $patient_data = [
        'name' => $patient_name,
        'age' => $age,
        'weight' => $weight,
        'diagnosis' => $diagnosis,
        'bmi' => round($bmi, 2),
        'diet_plan' => $diet_plan,
        'date' => date('Y-m-d H:i:s')
    ];

    // In a real system, save to database here
    // For now, we'll just pass the data to the results page
    $_SESSION['patient_data'] = $patient_data;
}

function determine_diet_plan($diagnosis, $bmi, $age, $allergies) {
    $recommendations = [];

    switch ($diagnosis) {
        case 'diabetes':
            $recommendations[] = "Low glycemic index foods: Whole grains, vegetables, lean proteins";
            $recommendations[] = "Limit sugary foods and drinks";
            $recommendations[] = "Regular meal times and portion control";
            break;
        case 'hypertension':
            $recommendations[] = "Low sodium diet: Avoid processed foods, use herbs for flavoring";
            $recommendations[] = "Increase potassium-rich foods: Bananas, spinach, potatoes";
            $recommendations[] = "Limit alcohol and caffeine";
            break;
        case 'heart_disease':
            $recommendations[] = "Low saturated fat diet: Use olive oil, avoid fried foods";
            $recommendations[] = "Increase omega-3 fatty acids: Fish, nuts, seeds";
            $recommendations[] = "High fiber foods: Whole grains, fruits, vegetables";
            break;
        case 'obesity':
            $recommendations[] = "Calorie-controlled diet: 500 calorie deficit per day";
            $recommendations[] = "High protein, low carb approach";
            $recommendations[] = "Regular exercise and portion control";
            break;
        case 'kidney_disease':
            $recommendations[] = "Low protein diet: Limit meat, dairy, and beans";
            $recommendations[] = "Control potassium and phosphorus: Avoid bananas, dairy, nuts";
            $recommendations[] = "Fluid restriction if necessary";
            break;
        default:
            $recommendations[] = "Balanced diet: Include variety of fruits, vegetables, proteins, and grains";
            $recommendations[] = "Portion control and regular meals";
            break;
    }

    // Add BMI-based recommendations
    if ($bmi < 18.5) {
        $recommendations[] = "Underweight: Increase calorie intake with healthy fats and proteins";
    } elseif ($bmi > 25) {
        $recommendations[] = "Overweight: Focus on portion control and increase physical activity";
    }

    // Add age-based recommendations
    if ($age > 65) {
        $recommendations[] = "Consider nutrient-dense foods and adequate protein for muscle maintenance";
    }

    // Add allergy considerations
    if (!empty($allergies)) {
        $recommendations[] = "Avoid allergens: " . $allergies;
    }

    return $recommendations;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diet Plan Results</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Patient Diet Determining Software</h1>
        <p>Personalized diet plan for <?php echo $patient_name; ?></p>
    </header>

    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="patient_form.php">New Patient</a></li>
            <li><a href="reports.php">Reports</a></li>
        </ul>
    </nav>

    <main>
        <section>
            <h2>Diet Plan for <?php echo $patient_name; ?></h2>
            
            <div class="patient-info">
                <p><strong>Age:</strong> <?php echo $age; ?> years</p>
                <p><strong>Weight:</strong> <?php echo $weight; ?> kg</p>
                <p><strong>BMI:</strong> <?php echo round($bmi, 2); ?></p>
                <p><strong>Diagnosis:</strong> <?php echo ucfirst(str_replace('_', ' ', $diagnosis)); ?></p>
                <?php if (!empty($allergies)): ?>
                    <p><strong>Allergies:</strong> <?php echo $allergies; ?></p>
                <?php endif; ?>
            </div>

            <div class="diet-plan">
                <h3>Recommended Diet Plan</h3>
                <ul>
                    <?php foreach ($diet_plan as $recommendation): ?>
                        <li><?php echo $recommendation; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="actions">
                <a href="reports.php?patient=<?php echo urlencode($patient_name); ?>&data=<?php echo urlencode(serialize($patient_data)); ?>">
                    <button>Generate Report</button>
                </a>
                <a href="patient_form.php"><button>New Patient</button></a>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Chitungwiza Central Hospital - Diet System 2.0</p>
    </footer>
</body>
</html>
