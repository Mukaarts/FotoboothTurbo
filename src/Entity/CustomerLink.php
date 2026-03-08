<?php

namespace App\Entity;

use App\Enum\TarifTier;
use App\Repository\CustomerLinkRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerLinkRepository::class)]
class CustomerLink
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'customerLink')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Project $project = null;

    #[ORM\Column(length: 64, unique: true)]
    private ?string $token = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $expiresAt = null;

    #[ORM\Column(type: 'string', enumType: TarifTier::class)]
    private TarifTier $tarifTier = TarifTier::STANDARD;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    public function __construct() { $this->createdAt = new \DateTimeImmutable(); }

    public function getId(): ?int { return $this->id; }
    public function getProject(): ?Project { return $this->project; }
    public function setProject(Project $project): static { $this->project = $project; return $this; }
    public function getToken(): ?string { return $this->token; }
    public function setToken(string $token): static { $this->token = $token; return $this; }
    public function getExpiresAt(): ?\DateTimeImmutable { return $this->expiresAt; }
    public function setExpiresAt(?\DateTimeImmutable $expiresAt): static { $this->expiresAt = $expiresAt; return $this; }
    public function getTarifTier(): TarifTier { return $this->tarifTier; }
    public function setTarifTier(TarifTier $tarifTier): static { $this->tarifTier = $tarifTier; return $this; }
    public function getCreatedAt(): \DateTimeImmutable { return $this->createdAt; }
}
