<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\CustomerLink;
use App\Entity\Event;
use App\Entity\Project;
use App\Entity\User;
use App\Enum\ProjectStatus;
use App\Enum\TarifTier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        // Admin user
        $admin = new User();
        $admin->setEmail('admin@fotobooth-turbo.de');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setDisplayName('Admin');
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'admin'));
        $manager->persist($admin);

        // Sample projects
        $projects = [
            [
                'title' => 'Hochzeit Schmidt & Weber',
                'status' => ProjectStatus::DRAFT,
                'tarif' => TarifTier::PREMIUM,
                'customer' => ['name' => 'Laura Schmidt', 'email' => 'laura.schmidt@gmail.com', 'company' => null, 'phone' => '+49 171 1234567'],
                'event' => ['date' => '+30 days', 'location' => 'Schloss Bensberg, Bergisch Gladbach', 'notes' => 'Vintage-Stil gewünscht, Farben: Creme & Gold. Gästebuch-Funktion wichtig.'],
            ],
            [
                'title' => 'Firmenfeier TechCorp GmbH',
                'status' => ProjectStatus::AWAITING_CUSTOMER,
                'tarif' => TarifTier::STANDARD,
                'customer' => ['name' => 'Markus Bauer', 'email' => 'mbauer@techcorp.de', 'company' => 'TechCorp GmbH', 'phone' => '+49 221 9876543'],
                'event' => ['date' => '+45 days', 'location' => 'Hyatt Regency, Köln', 'notes' => 'Corporate Design beachten. Logo wird nachgeliefert.'],
            ],
            [
                'title' => 'Geburtstag - 30. von Nina',
                'status' => ProjectStatus::APPROVED,
                'tarif' => TarifTier::BASIC,
                'customer' => ['name' => 'Thomas Krüger', 'email' => 'thomas.k@web.de', 'company' => null, 'phone' => null],
                'event' => ['date' => '+14 days', 'location' => 'Bootshaus, Köln', 'notes' => '80er-Jahre Party Motto!'],
            ],
            [
                'title' => 'Hochzeit Müller & Fischer',
                'status' => ProjectStatus::AWAITING_APPROVAL,
                'tarif' => TarifTier::PREMIUM,
                'customer' => ['name' => 'Anna Müller', 'email' => 'anna.mueller@outlook.de', 'company' => null, 'phone' => '+49 176 5551234'],
                'event' => ['date' => '+60 days', 'location' => 'Gut Lärchenhof, Pulheim', 'notes' => 'Blumenmotive, pastellfarben. Greenscreen gewünscht.'],
            ],
            [
                'title' => 'Sommerfest Stadtwerke Bonn',
                'status' => ProjectStatus::EXPORTED,
                'tarif' => TarifTier::STANDARD,
                'customer' => ['name' => 'Petra Hoffmann', 'email' => 'p.hoffmann@stadtwerke-bonn.de', 'company' => 'Stadtwerke Bonn', 'phone' => '+49 228 7771000'],
                'event' => ['date' => '-5 days', 'location' => 'Rheinaue, Bonn', 'notes' => null],
            ],
            [
                'title' => 'Abiball Gymnasium Rodenkirchen',
                'status' => ProjectStatus::DRAFT,
                'tarif' => TarifTier::BASIC,
                'customer' => ['name' => 'Sophia Wagner', 'email' => 'sophia.w@schule.de', 'company' => 'Gymnasium Rodenkirchen', 'phone' => null],
                'event' => ['date' => '+90 days', 'location' => 'Gürzenich, Köln', 'notes' => 'Motto: Hollywood Glamour. Budget begrenzt.'],
            ],
            [
                'title' => 'Produktlaunch StyleBrand',
                'status' => ProjectStatus::AWAITING_CUSTOMER,
                'tarif' => TarifTier::PREMIUM,
                'customer' => ['name' => 'Jan Richter', 'email' => 'jan@stylebrand.com', 'company' => 'StyleBrand AG', 'phone' => '+49 211 4445566'],
                'event' => ['date' => '+20 days', 'location' => 'Motorworld, Köln', 'notes' => 'Minimalistisch, schwarz-weiß. Social-Media-Integration gewünscht.'],
            ],
            [
                'title' => 'Weihnachtsfeier Kanzlei Bergmann',
                'status' => ProjectStatus::ARCHIVED,
                'tarif' => TarifTier::STANDARD,
                'customer' => ['name' => 'Dr. Klaus Bergmann', 'email' => 'bergmann@kanzlei-bergmann.de', 'company' => 'Kanzlei Bergmann & Partner', 'phone' => '+49 221 1112233'],
                'event' => ['date' => '-60 days', 'location' => 'Hotel Excelsior Ernst, Köln', 'notes' => null],
            ],
            [
                'title' => 'Taufe Klein-Emilia',
                'status' => ProjectStatus::DRAFT,
                'tarif' => TarifTier::BASIC,
                'customer' => ['name' => 'Sandra Klein', 'email' => 'sandra.klein@gmx.de', 'company' => null, 'phone' => '+49 177 9998877'],
                'event' => ['date' => '+75 days', 'location' => 'Landhaus Kuckuck, Köln', 'notes' => 'Zart, rosa Töne. Babyfotos-Rahmen.'],
            ],
            [
                'title' => 'Messe-Booth IFA 2026',
                'status' => ProjectStatus::APPROVED,
                'tarif' => TarifTier::PREMIUM,
                'customer' => ['name' => 'Michael Schulz', 'email' => 'm.schulz@innovatech.io', 'company' => 'InnovaTech GmbH', 'phone' => '+49 30 5556677'],
                'event' => ['date' => '+120 days', 'location' => 'Messe Berlin', 'notes' => 'LED-Hintergrund mit Firmenlogo. Sofortdruck + Digital-Sharing.'],
            ],
        ];

        foreach ($projects as $data) {
            $customer = new Customer();
            $customer->setName($data['customer']['name']);
            $customer->setEmail($data['customer']['email']);
            $customer->setCompany($data['customer']['company']);
            $customer->setPhone($data['customer']['phone']);

            $event = new Event();
            $event->setEventDate(new \DateTime($data['event']['date']));
            $event->setLocation($data['event']['location']);
            $event->setNotes($data['event']['notes']);

            $project = new Project();
            $project->setTitle($data['title']);
            $project->setStatus($data['status']);
            $project->setOwner($admin);
            $project->setCustomer($customer);
            $project->setEvent($event);

            $customerLink = new CustomerLink();
            $customerLink->setProject($project);
            $customerLink->setToken(bin2hex(random_bytes(32)));
            $customerLink->setTarifTier($data['tarif']);
            $project->setCustomerLink($customerLink);

            $manager->persist($project);
        }

        $manager->flush();
    }
}
