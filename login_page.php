<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Games Track Login</title>
</head>
<body>
<div class="login">
    <h1>Logowanie</h1>
    <form action="auth_login.php" method="post">
        Nazwa użytkownika: <input type="text" name="login" required><br>
        Hasło: <input type="password" name="userpwd" required><br>
        <input type="submit">
    </form>
    <a href="registration_page.php">Rejestracja</a>
</div>
</body>
</html>
