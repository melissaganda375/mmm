<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Patient Diet Determining Software</h1>
        <p>Create a new user account</p>
    </header>

    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="reports.php">Reports</a></li>
        </ul>
    </nav>

    <main>
        <section>
            <h2>User Registration</h2>
            <form action="register_process.php" method="post">
                <div class="form-group">
                    <label for="username">Username *</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password *</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirm Password *</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="full_name">Full Name *</label>
                    <input type="text" id="full_name" name="full_name" required>
                </div>
                
                <div class="form-group">
                    <label for="role">Role *</label>
                    <select id="role" name="role" required>
                        <option value="">Select role</option>
                        <option value="doctor">Doctor</option>
                        <option value="nurse">Nurse</option>
                        <option value="cook">Cook</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>
                
                <button type="submit">Register User</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Chitungwiza Central Hospital - Diet System 2.0</p>
    </footer>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (password !== confirmPassword) {
                alert('Passwords do not match!');
                return;
            }
            
            if (password.length < 6) {
                alert('Password must be at least 6 characters long!');
                return;
            }
            
            // Simulate registration process
            const registerBtn = document.querySelector('button[type="submit"]');
            registerBtn.textContent = 'Registering...';
            registerBtn.disabled = true;
            
            setTimeout(() => {
                alert('User registered successfully! You can now login.');
                registerBtn.textContent = 'Register User';
                registerBtn.disabled = false;
                
                // Redirect to login page
                window.location.href = 'login.php';
            }, 1500);
        });
    </script>
</body>
</html>
