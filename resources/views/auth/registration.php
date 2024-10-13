<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h1>Регистрация</h1>
<form action="/register" method="post">
    <p>
        <input type="email" name="email" placeholder="E-mail" required>
    </p>
    <p>
        <input type="password" name="password" placeholder="Пароль" required>
    </p>
    <p>
        <input type="password" name="password_confirmation" placeholder="Подтверждение пароля" required>
    </p>
    <p>
        <input type="checkbox" name="personal_confirmation" required> Даю согласие на обработку персональных данных
    </p>
    <p>
        <button type="submit">Зарегистрироваться</button>
    </p>
</form>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
