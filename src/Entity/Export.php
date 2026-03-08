<?php

namespace App\Entity;

use App\Repository\ExportRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExportRepository::class)]
class Export
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'exports')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Project $project = null;

    #[ORM\Column(length: 500)]
    private ?string $zipPath = null;

    #[ORM\Column(length: 50)]
    private string $targetSoftware = 'breeze_remote_pro';

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    public function __construct() { $this->createdAt = new \DateTimeImmutable(); }

    public function getId(): ?int { return $this->id; }
    public function getProject(): ?Project { return $this->project; }
    public function setProject(Project $project): static { $this->project = $project; return $this; }
    public function getZipPath(): ?string { return $this->zipPath; }
    public function setZipPath(string $zipPath): static { $this->zipPath = $zipPath; return $this; }
    public function getTargetSoftware(): string { return $this->targetSoftware; }
    public function setTargetSoftware(string $targetSoftware): static { $this->targetSoftware = $targetSoftware; return $this; }
    public function getCreatedAt(): \DateTimeImmutable { return $this->createdAt; }
}
