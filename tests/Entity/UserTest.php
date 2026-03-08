<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetUserIdentifierReturnsEmail(): void
    {
        $user = new User();
        $user->setEmail('admin@example.com');

        $this->assertSame('admin@example.com', $user->getUserIdentifier());
    }

    public function testDefaultRolesIncludesRoleUser(): void
    {
        $user = new User();

        $this->assertContains('ROLE_USER', $user->getRoles());
    }

    public function testSetRolesPreservesRoleUser(): void
    {
        $user = new User();
        $user->setRoles(['ROLE_ADMIN']);

        $roles = $user->getRoles();
        $this->assertContains('ROLE_ADMIN', $roles);
        $this->assertContains('ROLE_USER', $roles);
    }

    public function testDisplayName(): void
    {
        $user = new User();
        $user->setDisplayName('Admin User');

        $this->assertSame('Admin User', $user->getDisplayName());
    }
}
