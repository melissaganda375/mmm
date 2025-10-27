<?php
// database.php - Database connection and utility functions

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "diet_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to save patient data
function save_patient_data($patient_data) {
    global $conn;
    
    $stmt = $conn->prepare("INSERT INTO patients (name, age, weight, diagnosis, bmi, diet_plan, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $diet_plan_json = json_encode($patient_data['diet_plan']);
    
    $stmt->bind_param("sdssdss", $patient_data['name'], $patient_data['age'], $patient_data['weight'], $patient_data['diagnosis'], $patient_data['bmi'], $diet_plan_json, $patient_data['date']);
    
    if ($stmt->execute()) {
        return $conn->insert_id;
    } else {
        return false;
    }
}

// Function to get patient data
function get_patient_data($patient_id) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM patients WHERE id = ?");
    $stmt->bind_param("i", $patient_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

// Function to get all patients
function get_all_patients() {
    global $conn;
    
    $result = $conn->query("SELECT * FROM patients ORDER BY created_at DESC");
    
    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

// Close connection (call this at the end of scripts that use the database)
function close_database_connection() {
    global $conn;
    $conn->close();
}
?>
