<?php
function renderTree(array $list, $parent_id = null): void
{
    $nodes = array_filter($list, fn ($i) => $i['parent_id'] === $parent_id);

    if (!empty($nodes)) {
        echo '<ul>';
        foreach ($nodes as $node) {
            echo '<li>';
            echo "<span>{$node['name']}</span>";
            renderTree($list, $node['id']);
            echo '</li>';
        }
        echo '</ul>';
    }
}
