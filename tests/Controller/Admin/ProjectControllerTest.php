<?php

namespace App\Tests\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProjectControllerTest extends WebTestCase
{
    public function testNewProjectFormRequiresAuthentication(): void
    {
        $client = static::createClient();
        $client->request('GET', '/admin/project/new');

        $this->assertResponseRedirects('/login');
    }

    public function testNewProjectFormLoads(): void
    {
        $client = static::createClient();
        $user = $this->createAdminUser();

        $client->loginUser($user);
        $client->request('GET', '/admin/project/new');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('form');
    }

    private function createAdminUser(): User
    {
        $container = static::getContainer();
        /** @var EntityManagerInterface $em */
        $em = $container->get(EntityManagerInterface::class);
        /** @var UserPasswordHasherInterface $hasher */
        $hasher = $container->get(UserPasswordHasherInterface::class);

        $user = new User();
        $user->setEmail('test-admin-' . uniqid() . '@test.de');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setDisplayName('Test Admin');
        $user->setPassword($hasher->hashPassword($user, 'password'));

        $em->persist($user);
        $em->flush();

        return $user;
    }
}
