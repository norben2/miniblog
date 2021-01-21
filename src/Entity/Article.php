<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArticleRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Controller\ArticleUpdatesAt;


/**
 * @ApiResource(
 * collectionOperations={
 *          "get" ={
 *              "normalization_context"={"groups"={"article_read"}}
 *           },
 *          "post"
 *      },
 *     itemOperations={
 *          "get"={
 *              "normalization_context"={"groups"={"article_details_read"}}
 *           },
 *          "put",
 *          "patch",
 *          "delete",
 *          "post_updated_ut"={
 *            "method"="PUT",
 *            "path"="/articles/{id}/updated-at",
 *            "controller"=ArticleUpdatesAt::class,
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    use ResourceId;
    use Timestampable;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_details_read","article_read","article_details_read"})
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Groups({"user_details_read","article_details_read", "article_read"})
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="articles")
     * @Groups({"article_details_read"})
     */
    private $author;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }
}
