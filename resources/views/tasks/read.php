<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h1><?php echo $task->getAttr('title') ?></h1>

<?php if (!empty($task->getAttr('parent_id'))) { ?>
    <h3><a href="/tasks/read?id=<?php echo $task->getAttr('parent_id') ?>">Родительская задача</a></h3>
<?php } ?>

<p>Создана: <?php echo $task->getAttr('created_at') ?></p>

<p>Дэдлайн: <?php echo $task->getAttr('deadline') ?></p>
<?php if (!empty($task->getAttr('finished_at'))) { ?>
    <p>Завершена: <?php echo $task->getAttr('finished_at') ?? '-' ?></p>
<?php } ?>

<p><a href="/tasks/edit?id=<?php echo $task->getId() ?>">Редактировать</a></p>

<form action="/tasks/complete" method="post">
    <input type="hidden" name="id" value="<?php echo $task->getId() ?>">
    <button type="submit">Завершить задачу</button>
</form>

<form action="/tasks/delete" method="post" style="margin-top: 3em;">
    <input type="hidden" name="id" value="<?php echo $task->getId() ?>">
    <button type="submit">Удалить задачу</button>
</form>

<p><a href="/tasks">Вернуться в список задач</a></p>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
