<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(name: 'app:create-admin', description: 'Creates an admin user')]
class CreateAdminCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'Admin email')
            ->addArgument('password', InputArgument::REQUIRED, 'Admin password')
            ->addOption('name', null, InputOption::VALUE_OPTIONAL, 'Display name', 'Admin');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $user = new User();
        $user->setEmail($input->getArgument('email'));
        $user->setRoles(['ROLE_ADMIN']);
        $user->setDisplayName($input->getOption('name'));
        $user->setPassword($this->passwordHasher->hashPassword($user, $input->getArgument('password')));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $io->success('Admin user created: ' . $user->getEmail());
        return Command::SUCCESS;
    }
}
