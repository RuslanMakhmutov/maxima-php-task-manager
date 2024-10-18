<form action="/tasks/<?php echo !empty($edit) ? 'update' : 'create' ?>" method="post">
    <?php if (!empty($edit)) { ?>
        <input type="hidden" name="id" value="<?php echo $task?->getId() ?>">
    <?php } ?>
    <p>
        <input type="text" name="title" value="<?php echo $task?->getAttr('title') ?? '' ?>" placeholder="Заголовок" required>
    </p>
    <p>
        <label for="deadline">Дэдлайн</label>
        <input type="datetime-local" name="deadline" id="deadline" value="<?php echo !empty($task?->getAttr('deadline')) ? date('Y-m-d\TH:i', strtotime($task->getAttr('deadline'))) : '' ?>" placeholder="Дэдлайн" required>
    </p>
    <p>
        <label for="parent_id">Родительская задача</label>
        <select name="parent_id" id="parent_id">
            <option value=""></option>
            <?php foreach ($tasks ?? [] as $item) { ?>
                <option value="<?php echo $item->getId() ?>" <?php echo ($task?->getAttr('parent_id') ?? null == $item->getId()) ? 'selected' : '' ?> <?php echo (($task?->getId() ?? null) == $item->getId()) ? 'disabled' : '' ?>>
                    <?php echo str_repeat("--", $item->getAttr('level')) . ' ' . $item->getAttr('title') ?>
                </option>
            <?php } ?>
        </select>
    </p>
    <p>
        <button type="submit"><?php echo !empty($edit) ? 'Сохранить' : 'Создать' ?></button>
    </p>
</form>
