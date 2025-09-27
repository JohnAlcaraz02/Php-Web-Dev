<?php
session_start();

$error = '';

// Include the database connection
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Prepare and execute query
    $result = pg_query_params($conn, "SELECT password FROM users WHERE email = $1", [$email]);

    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        $hashed_password = $row['password'];

        // If you store hashed passwords (recommended), use password_verify:
        // if (password_verify($password, $hashed_password)) {
        if ($password === $hashed_password) { // For plain text (not recommended)
            $_SESSION['user'] = $email;
            header("Location: name.php");
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="floating-orbs">
        <div class="orb"></div>
        <div class="orb"></div>
        <div class="orb"></div>
        <div class="orb"></div>
        <div class="orb"></div>
        <div class="orb"></div>
        <div class="orb"></div>
    </div>
    <div class="login-container">
        <h2>Log In</h2>
        <?php if ($error): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class ="form-group">
                <input type="email" name="email" id="email" placeholder=" " required>
                <label for="email">Email</label>
            </div>
            <div class ="form-group">
                <input type="password" name="password" id="password" placeholder=" " required>
                <label for="password">Password</label>
                <button type="button" class="password-toggle" onclick="togglePassword()" id="toggleBtn">
                    <svg class="eye-icon" viewBox="0 0 24 24">
                        <path d="M12 4.5C7.3 4.5 3.5 7.9 2 12.5c1.5 4.6 5.3 8 10 8s8.5-3.4 10-8c-1.5-4.6-5.3-8-10-8zm0 13c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5zm0-8c-1.7 0-3 1.3-3 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3z"/>
                    </svg>
                </button>
            </div>
            <div>
            <button type="submit" class="print-btn" id="loginBtn" onclick="createWaveEffect(event)">
                    <div class="loading-spinner"></div>
                    <span class="button-text">Log In</span>
                </button>
            </div>
        </form>
    </div>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.getElementById('toggleBtn');
            const eyeIcon = toggleButton.querySelector('.eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                // Change to "eye with slash" icon when password is visible
                eyeIcon.innerHTML = '<path d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z"/>';
            } else {
                passwordInput.type = 'password';
                // Change back to normal eye icon when password is hidden
                eyeIcon.innerHTML = '<path d="M12 4.5C7.3 4.5 3.5 7.9 2 12.5c1.5 4.6 5.3 8 10 8s8.5-3.4 10-8c-1.5-4.6-5.3-8-10-8zm0 13c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5zm0-8c-1.7 0-3 1.3-3 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3z"/>';
            }
        }
        function createWaveEffect(e) {
            const button = e.currentTarget;
            const rect = button.getBoundingClientRect();
            const wave = document.createElement('span');
            
            // Calculate click position relative to button
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            // Create wave element
            wave.className = 'wave-effect';
            wave.style.width = wave.style.height = '20px';
            wave.style.left = (x - 10) + 'px';
            wave.style.top = (y - 10) + 'px';
            
            // Add wave to button
            button.appendChild(wave);
            
            // Remove wave after animation completes
            setTimeout(() => {
                if (wave.parentNode) {
                    wave.parentNode.removeChild(wave);
                }
            }, 600);
        }
        function handleFormSubmit(event) {
            event.preventDefault();
            
            const loginBtn = document.getElementById('loginBtn');
            const buttonText = loginBtn.querySelector('.button-text');
            
            loginBtn.classList.add('loading');
            loginBtn.disabled = true;
            buttonText.textContent = 'Logging in...';
            
            setTimeout(() => {
                loginBtn.classList.remove('loading');
                loginBtn.disabled = false;
                buttonText.textContent = 'Log In';
                
                // Show demo error message
                document.getElementById('demoError').style.display = 'flex';
                setTimeout(() => {
                    document.getElementById('demoError').style.display = 'none';
                }, 4000);
            }, 2500);
        }

        // Demo: Show error after a few seconds for demonstration
        setTimeout(() => {
            document.getElementById('demoError').style.display = 'flex';
            setTimeout(() => {
                document.getElementById('demoError').style.display = 'none';
            }, 3000);
        }, 2000);
    </script>
</body>
</html>
