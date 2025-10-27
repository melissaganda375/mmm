<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diet System - Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Patient Diet Determining Software</h1>
        <p>Please login to access the system</p>
    </header>

    <main>
        <div class="login-container">
            <button class="close-btn" onclick="closeForm()" title="Close Form">&times;</button>
            
            <div class="header">
                <h2>Diet System Login</h2>
                <p class="subtitle">Please login to continue</p>
            </div>

            <form id="loginForm" action="patient_form.php" method="post">
                <div class="form-group">
                    <label for="username">Username *</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        placeholder="Enter your username"
                        required
                    >
                </div>
                
                <div class="form-group">
                    <label for="password">Password *</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Enter your password"
                        required
                    >
                </div>
                
                <button type="submit" class="login-btn">Login to System</button>
            </form>

            <div class="divider">
                <span>or</span>
            </div>

            <div class="new-user">
                <a href="register.php">New User? Register Here</a>
            </div>
        </div>
    </main>

    <script>
        function closeForm() {
            if (confirm('Are you sure you want to close the login form?')) {
                window.location.href = 'index.html';
            }
        }

        function handleNewUser(event) {
            event.preventDefault();
            
            if (confirm('Would you like to register as a new user?')) {
                alert('Redirecting to Registration...\n\nIn a real system, this would take you to the registration form.');
            }
        }

        document.getElementById('loginForm').addEventListener('submit', function(event) {
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value;

            if (!username || !password) {
                alert('Please fill in all required fields');
                event.preventDefault();
                return;
            }

            // Simulate login process
            const loginBtn = document.querySelector('.login-btn');
            loginBtn.textContent = 'Logging in...';
            loginBtn.disabled = true;

            setTimeout(() => {
                alert(`Welcome ${username}!\n\nLogin successful for Diet System.`);
                loginBtn.textContent = 'Login to System';
                loginBtn.disabled = false;
                
                // Allow form to submit normally to patient_form.php
            }, 1500);
        });
    </script>
</body>
</html>
