<?php

namespace Classes;

use SplObserver;
use SplSubject;

class UserObserver implements SplObserver
{
    /**
     * @var SplSubject[]
     */
    private array $changedUsers = [];

    /**
     * It is called by the Subject, usually by SplSubject::notify()
     */
    public function update(SplSubject $subject, string $event = null): void
    {
        $this->changedUsers[] = clone $subject;
        echo date("Y-m-d H:i:s") . ": User $subject->name has $event <br>";
    }

    /**
     * @return SplSubject[]
     */
    public function getChangedUsers(): array
    {
        return $this->changedUsers;
    }
}
