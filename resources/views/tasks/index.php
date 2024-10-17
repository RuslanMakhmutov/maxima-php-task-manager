<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h1>Список задач</h1>

<?php
if (!empty($tasks)) {
    \app\Services\TaskService::renderTree($tasks);
}
?>

<p><a href="/tasks/add">Создать новую задачу</a></p>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
