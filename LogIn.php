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
    <div class="login-container">
        <h2>Login</h2>
        <?php if ($error): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required autofocus>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div>
                <button type="submit" class="print-btn">Log In</button>
            </div>
        </form>
    </div>
</body>
</html>