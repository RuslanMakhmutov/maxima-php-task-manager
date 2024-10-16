<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h1>Список задач</h1>

<?php if (!empty($tasks)) { ?>
    <ul>
        <?php foreach ($tasks as $task) { ?>
            <li><a href="/tasks/read?id=<?php echo $task->getAttr('id') ?>"><?php echo $task->getAttr('title') ?></a></li>
        <?php } ?>
    </ul>
<?php } ?>

<p><a href="/tasks/add">Создать новую задачу</a></p>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
