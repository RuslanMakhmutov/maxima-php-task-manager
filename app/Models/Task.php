<?php

namespace app\Models;

use SplObjectStorage;
use SplObserver;
use SplSubject;

/**
 * Класс для работы с задачами
 */
class Task extends Model implements SplSubject
{
    protected static string $table = 'tasks';
    protected static array $fields = [
        'title',
        'parent_id',
        'deadline',
    ];
    protected int $id;
    protected string $title;
    protected int $user_id;
    protected string $created_at;
    protected ?string $parent_id;
    protected ?string $deadline;
    protected ?string $finished_at;
    private SplObjectStorage $observers;

    public function __construct()
    {
        $this->observers = new SplObjectStorage();
    }

    public function complete(): void
    {
        $this->finished_at = date("Y-m-d H:i:s");

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
