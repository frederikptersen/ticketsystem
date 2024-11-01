<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="Assets/css/loginstyle.css">
</head>
<body>

<div class="login-container">
    <h2>Admin Login</h2>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST" action="login.php">
        <div class="form-group">
            <label for="username">Brugernavn:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Adgangskode:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Log ind</button>
    </form>
</div>

</body>
</html>
