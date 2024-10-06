<?php

namespace Classes;

use SplObserver;
use SplSubject;

class TaskObserver implements SplObserver
{
    /**
     * @var SplSubject[]
     */
    private array $changedTasks = [];

    /**
     * It is called by the Subject, usually by SplSubject::notify()
     */
    public function update(SplSubject $subject, string $event = null): void
    {
        $this->changedTasks[] = clone $subject;
        echo date("Y-m-d H:i:s") . ": Task $subject->name has $event <br>";
    }

    /**
     * @return SplSubject[]
     */
    public function getChangedTasks(): array
    {
        return $this->changedTasks;
    }
}
