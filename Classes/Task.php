<?php

namespace Classes;


use SplObjectStorage;
use SplObserver;
use SplSubject;

/**
 * Класс для работы с задачами
 */
class Task implements SplSubject
{
    protected int $id;
    public string $name;
    public int $user_id;
    public bool $done = false;
    private SplObjectStorage $observers;

    public function __construct()
    {
        $this->observers = new SplObjectStorage();
    }

    public function complete(): void
    {
        $this->done = true;

        $this->notify("done");
    }

    public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    public function notify(string $event = ''): void
    {
        /** @var SplObserver $observer **/
        foreach ($this->observers as $observer) {
            $observer->update($this, $event);
        }
    }
}
