<?php declare(strict_types=1);

namespace App\Bus\Event;

final class BookCreatedEvent
{
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
