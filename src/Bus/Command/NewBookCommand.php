<?php declare(strict_types=1);

namespace App\Bus\Command;

final class NewBookCommand
{
    /** @var int */
    public $id;
    /** @var string */
    public $name;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}