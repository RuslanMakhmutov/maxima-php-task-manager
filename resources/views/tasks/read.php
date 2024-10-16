<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h1><?php echo $task->getAttr('title') ?></h1>

<p>Создана: <?php echo $task->getAttr('created_at') ?></p>
<?php if (!empty($task->getAttr('parent_id'))) { ?>
    <p><a href="/tasks/<?php echo $task->getAttr('parent_id') ?>">Родительская задача</a></p>
<?php } ?>
<p>Дэдлайн: <?php echo $task->getAttr('deadline') ?></p>
<?php if (!empty($task->getAttr('finished_at'))) { ?>
    <p>Завершена: <?php echo $task->getAttr('finished_at') ?? '-' ?></p>
<?php } ?>

<p><a href="/tasks/edit?id=<?php echo $task->getId() ?>">Редактировать</a></p>

<p><a href="/tasks">Вернуться в список задач</a></p>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
