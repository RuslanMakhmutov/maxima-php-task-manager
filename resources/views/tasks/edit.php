<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h1>Редактирование задачи «<?php echo $task->getAttr('title') ?>»</h1>

<?php
    $edit = true;
    include __DIR__ . '/form.php';
?>

<p><a href="/tasks/read?id=<?php echo $task->getId() ?>">Вернуться в задачу</a></p>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
