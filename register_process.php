<?php
session_start();

// Simple user registration processing
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = trim($_POST['email']);
    $full_name = trim($_POST['full_name']);
    $role = $_POST['role'];
    
    // Validation
    if (empty($username) || empty($password) || empty($email) || empty($full_name) || empty($role)) {
        $_SESSION['error'] = 'All fields are required!';
        header('Location: register.php');
        exit();
    }
    
    if ($password !== $confirm_password) {
        $_SESSION['error'] = 'Passwords do not match!';
        header('Location: register.php');
        exit();
    }
    
    if (strlen($password) < 6) {
        $_SESSION['error'] = 'Password must be at least 6 characters long!';
        header('Location: register.php');
        exit();
    }
    
    // Simple user storage (in a real application, use a database)
    $users_file = 'users.txt';
    $users = [];
    
    if (file_exists($users_file)) {
        $users = json_decode(file_get_contents($users_file), true);
    }
    
    // Check if username already exists
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            $_SESSION['error'] = 'Username already exists!';
            header('Location: register.php');
            exit();
        }
    }
    
    // Add new user
    $new_user = [
        'username' => $username,
        'password' => password_hash($password, PASSWORD_DEFAULT), // Hash the password
        'email' => $email,
        'full_name' => $full_name,
        'role' => $role,
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    $users[] = $new_user;
    file_put_contents($users_file, json_encode($users));
    
    $_SESSION['success'] = 'User registered successfully! You can now login.';
    header('Location: login.php');
    exit();
}
?>
