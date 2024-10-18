<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h1>Список пользователей</h1>

<?php if (!empty($users)) { ?>
    <?php foreach ($users as $user) { ?>
        <div><a href="/users/read?id=<?php echo $user->getAttr('id') ?>"><?php echo $user->getAttr('name') ?></a></div>
        <div>Задач: <?php echo count($user->tasks ?? []) ?></div>
        <hr>
    <?php } ?>
<?php } ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
