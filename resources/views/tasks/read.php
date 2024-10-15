<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h1>Задача: <?php echo $task->getAttr('title') ?></h1>

<p>Создана: <?php echo $task->getAttr('created_at') ?></p>
<?php if (!empty($task->getAttr('parent_id'))) { ?>
    <p><a href="/tasks/<?php echo $task->getAttr('parent_id') ?>">Родительская задача</a></p>
<?php } ?>
<p>Дэдлайн: <?php echo $task->getAttr('deadline') ?></p>
<p>Завершена: <?php echo $task->getAttr('finished_at') ?? '-' ?></p>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
