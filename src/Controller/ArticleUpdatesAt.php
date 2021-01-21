<?php

namespace App\Controller;

use App\Entity\Article;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleUpdatesAt extends AbstractController
{

    public function __invoke(Article $data): Article
    {
        $data->setUpdatedAt(new DateTimeImmutable("tomorrow"));
        return $data;
    }
}
