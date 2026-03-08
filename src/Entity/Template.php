<?php

namespace App\Entity;

use App\Repository\TemplateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TemplateRepository::class)]
class Template
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?array $tags = null;

    #[ORM\Column(length: 20)]
    private string $source = 'upload';

    #[ORM\Column(nullable: true)]
    private ?array $configSchema = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $thumbnailPath = null;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    public function __construct() { $this->createdAt = new \DateTimeImmutable(); }

    public function getId(): ?int { return $this->id; }
    public function getName(): ?string { return $this->name; }
    public function setName(string $name): static { $this->name = $name; return $this; }
    public function getTags(): ?array { return $this->tags; }
    public function setTags(?array $tags): static { $this->tags = $tags; return $this; }
    public function getSource(): string { return $this->source; }
    public function setSource(string $source): static { $this->source = $source; return $this; }
    public function getConfigSchema(): ?array { return $this->configSchema; }
    public function setConfigSchema(?array $configSchema): static { $this->configSchema = $configSchema; return $this; }
    public function getThumbnailPath(): ?string { return $this->thumbnailPath; }
    public function setThumbnailPath(?string $thumbnailPath): static { $this->thumbnailPath = $thumbnailPath; return $this; }
    public function getCreatedAt(): \DateTimeImmutable { return $this->createdAt; }
}
