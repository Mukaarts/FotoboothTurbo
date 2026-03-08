<?php

namespace App\Entity;

use App\Repository\DesignRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DesignRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Design
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'design')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Project $project = null;

    #[ORM\ManyToOne]
    private ?Template $template = null;

    #[ORM\Column(nullable: true)]
    private ?array $customizations = null;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column]
    private \DateTimeImmutable $updatedAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    public function setUpdatedAtValue(): void { $this->updatedAt = new \DateTimeImmutable(); }

    public function getId(): ?int { return $this->id; }
    public function getProject(): ?Project { return $this->project; }
    public function setProject(Project $project): static { $this->project = $project; return $this; }
    public function getTemplate(): ?Template { return $this->template; }
    public function setTemplate(?Template $template): static { $this->template = $template; return $this; }
    public function getCustomizations(): ?array { return $this->customizations; }
    public function setCustomizations(?array $customizations): static { $this->customizations = $customizations; return $this; }
    public function getCreatedAt(): \DateTimeImmutable { return $this->createdAt; }
    public function getUpdatedAt(): \DateTimeImmutable { return $this->updatedAt; }
}
