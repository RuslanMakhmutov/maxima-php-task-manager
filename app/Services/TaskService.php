<?php

namespace App\Services;

class TaskService
{
    public static function getTree(array $list, $parent_id = null, &$tree = [], $level = 0): array
    {
        $nodes = array_filter($list, fn ($i) => $i->getAttr('parent_id') === $parent_id);

        foreach ($nodes as $node) {
            $node->setLevel($level);
            $tree[] = $node;
            self::getTree($list, $node->getId(), $tree, $level + 1);
        }

        return $tree;
    }

    public static function renderTree(array $list, $parent_id = null): void
    {
        $nodes = array_filter($list, fn ($i) => $i->getAttr('parent_id') === $parent_id);

        if (!empty($nodes)) {
            echo '<ul>';
            foreach ($nodes as $node) {
                echo '<li>';
                echo '<a href="/tasks/read?id=' . $node->getAttr('id') . '">' . $node->getAttr('title') . '</a>';
                self::renderTree($list, $node->getId());
                echo '</li>';
            }
            echo '</ul>';
        }
    }
}
