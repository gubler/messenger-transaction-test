<?php declare(strict_types=1);

namespace App\Command;

use App\Bus\Command\NewBookCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class AddBookCommand extends Command
{
    private $commandBus;

    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:add-book';

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Creates a book.')
            ->setHelp('This command creates a book')
            ->addArgument('id', InputOption::VALUE_REQUIRED, 'ID for Book')
            ->addArgument('name', InputOption::VALUE_REQUIRED, 'Name for Book')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $this->commandBus->dispatch(
                new NewBookCommand(
                    (int) $input->getArgument('id'),
                    $input->getArgument('name')
                )
            );
        } catch (\Exception $e) {
            $output->writeln('Exception Occurred!');
        }

        $output->writeln('Done!');
    }
}
