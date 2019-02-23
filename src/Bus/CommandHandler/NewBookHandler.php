<?php declare(strict_types=1);

namespace App\Bus\CommandHandler;

use App\Bus\Command\NewBookCommand;
use App\Bus\Event\BookCreatedEvent;
use App\Entity\Book;
use App\Lib\Messenger\Stamp\Transaction;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

final class NewBookHandler
{
    private $manager;
    private $eventBus;

    public function __construct(EntityManagerInterface $manager, MessageBusInterface $eventBus)
    {
        $this->manager = $manager;
        $this->eventBus = $eventBus;
    }

    public function __invoke(NewBookCommand $command)
    {
        $this->manager->persist(new Book($command));

        $message = new BookCreatedEvent($command->id);
        $this->eventBus->dispatch((new Envelope($message))->with(new Transaction()));
    }
}