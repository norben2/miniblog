<?php

namespace App\Tests\Unit;

use App\Entity\User;
use App\Entity\Article;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    private Article $article;
    protected function setUp(): void
    {
        parent::setUp();
        $this->article = new Article();
    }

    public function testGetName(): void
    {
        $value = 'super name';
        $response = $this->article->setName($value);

        self::assertInstanceOf(Article::class, $response);
        self::assertEquals($value, $response->getName());
    }

    public function testGetContent(): void
    {
        $value = 'super content';
        $response = $this->article->setContent($value);

        self::assertInstanceOf(Article::class, $response);
        self::assertEquals($this->article->getContent(), $value);
    }

    public function testGetAuthor(): void
    {
        $value = new User();
        $response = $this->article->setAuthor($value);

        self::assertInstanceOf(Article::class, $response);
        self::assertInstanceOf(User::class, $this->article->getAuthor());
    }
}
