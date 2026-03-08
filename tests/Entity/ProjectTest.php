<?php

namespace App\Tests\Entity;

use App\Entity\Customer;
use App\Entity\Event;
use App\Entity\Project;
use App\Entity\User;
use App\Enum\ProjectStatus;
use PHPUnit\Framework\TestCase;

class ProjectTest extends TestCase
{
    public function testDefaultStatusIsDraft(): void
    {
        $project = new Project();

        $this->assertSame(ProjectStatus::DRAFT, $project->getStatus());
    }

    public function testProjectStatusLabels(): void
    {
        $this->assertSame('Entwurf', ProjectStatus::DRAFT->label());
        $this->assertSame('Warten auf Kunde', ProjectStatus::AWAITING_CUSTOMER->label());
        $this->assertSame('Warten auf Freigabe', ProjectStatus::AWAITING_APPROVAL->label());
        $this->assertSame('Freigegeben', ProjectStatus::APPROVED->label());
        $this->assertSame('Exportiert', ProjectStatus::EXPORTED->label());
        $this->assertSame('Archiviert', ProjectStatus::ARCHIVED->label());
    }

    public function testProjectStatusBadgeColors(): void
    {
        $this->assertSame('gray', ProjectStatus::DRAFT->badgeColor());
        $this->assertSame('green', ProjectStatus::APPROVED->badgeColor());
        $this->assertSame('blue', ProjectStatus::EXPORTED->badgeColor());
    }

    public function testSetTitle(): void
    {
        $project = new Project();
        $project->setTitle('Hochzeit Müller');

        $this->assertSame('Hochzeit Müller', $project->getTitle());
    }

    public function testSetCustomerAndEvent(): void
    {
        $project = new Project();
        $customer = new Customer();
        $customer->setName('Max Mustermann');
        $event = new Event();
        $event->setLocation('Berlin');

        $project->setCustomer($customer);
        $project->setEvent($event);

        $this->assertSame($customer, $project->getCustomer());
        $this->assertSame($event, $project->getEvent());
    }

    public function testSetOwner(): void
    {
        $project = new Project();
        $user = new User();
        $user->setEmail('admin@test.de');

        $project->setOwner($user);

        $this->assertSame($user, $project->getOwner());
    }

    public function testTimestampsAreSetOnConstruction(): void
    {
        $project = new Project();

        $this->assertInstanceOf(\DateTimeImmutable::class, $project->getCreatedAt());
        $this->assertInstanceOf(\DateTimeImmutable::class, $project->getUpdatedAt());
    }
}
