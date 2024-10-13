<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h1>Вход</h1>
<form action="/auth" method="post">
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

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
