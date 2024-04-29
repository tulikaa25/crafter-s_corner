<?php
// Start session to manage user sessions
session_start();

// Simulated user database (replace with your actual database connection)
$users = [
    'user1' => 'password1',
    'user2' => 'password2',
    // Add more users as needed
];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username exists in the database
    if (array_key_exists($username, $users)) {
        // Verify the password
        if ($password == $users[$username]) {
            // Authentication successful
            $_SESSION['username'] = $username;
            // Redirect to homepage
            header("Location: homepage.html");
            exit(); // Terminate script
        } else {
            // Incorrect password
            $error_message = "Incorrect password";
        }
    } else {
        // Username does not exist
        $error_message = "Username not found";
    }
}
?>

<!-- HTML form for user login -->
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <!-- Display error message if authentication fails -->
    <?php if (isset($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
    <?php } ?>
    <!-- Login form -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
