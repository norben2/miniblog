<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Entity\Article;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;
    protected function setUp(): void
    {
        parent::setUP();

        $this->user = new User();
    }
    public function testGetEmail(): void
    {

        $value = 'test@test.com';
        $newUser = $this->user->setEmail($value);

        $getEmail = $this->user->getEmail();


        self::assertInstanceOf(User::class, $newUser);
        self::assertEquals($value, $this->user->getEmail());
        self::assertEquals($value, $this->user->getUsername());
    }

    public function testGetRoles(): void
    {
        $role[] = 'ROLE_ADMIN';
        $this->user->setRoles($role);
        self::assertContains('ROLE_USER', $this->user->getRoles());
        self::assertContains('ROLE_ADMIN', $this->user->getRoles());
    }

    public function testGetPassword(): void
    {
        $password = 'password';
        $this->user->setPassword($password);
        self::assertEquals($password, $this->user->getPassword());
    }


    public function testGetArticles(): void
    {
        $article = new Article();
        $newUser = $this->user->addArticle($article);

        self::assertInstanceof(USER::class, $newUser);
        self::assertCount(1, $this->user->getArticles());
        self::assertTrue($this->user->getArticles()->contains($article));

        $newUser = $this->user->removeArticle($article);

        self::assertInstanceof(USER::class, $newUser);
        self::assertCount(0, $this->user->getArticles());
        self::assertFalse($this->user->getArticles()->contains($article));
    }
}
