<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
</head>
<body>
<h1>Вход</h1>
<form action="/auth.php" method="post">
    <p>
        <input type="email" name="email" placeholder="E-mail" required>
    </p>
    <p>
        <input type="password" name="password" placeholder="Пароль" required>
    </p>
    <p>
        <button type="submit">Войти</button>
    </p>
</form>
</body>
</html>
