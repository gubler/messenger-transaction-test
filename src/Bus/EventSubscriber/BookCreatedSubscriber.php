<?php declare(strict_types=1);

namespace App\Bus\EventSubscriber;

use App\Bus\Event\BookCreatedEvent;
use Symfony\Component\VarDumper\VarDumper;

final class BookCreatedSubscriber
{
    public function __invoke(BookCreatedEvent $event)
    {
        VarDumper::dump($event);
    }
}
