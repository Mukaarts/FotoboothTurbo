<?php

namespace App\Entity;

use App\Enum\ProjectStatus;
use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: 'string', enumType: ProjectStatus::class)]
    private ProjectStatus $status = ProjectStatus::DRAFT;

    #[ORM\ManyToOne(inversedBy: 'projects')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Event $event = null;

    #[ORM\OneToOne(mappedBy: 'project', cascade: ['persist', 'remove'])]
    private ?CustomerLink $customerLink = null;

    #[ORM\OneToOne(mappedBy: 'project', cascade: ['persist', 'remove'])]
    private ?Design $design = null;

    /** @var Collection<int, ApprovalLog> */
    #[ORM\OneToMany(targetEntity: ApprovalLog::class, mappedBy: 'project', cascade: ['persist', 'remove'])]
    #[ORM\OrderBy(['createdAt' => 'DESC'])]
    private Collection $approvalLogs;

    /** @var Collection<int, Export> */
    #[ORM\OneToMany(targetEntity: Export::class, mappedBy: 'project', cascade: ['persist', 'remove'])]
    private Collection $exports;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column]
    private \DateTimeImmutable $updatedAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->approvalLogs = new ArrayCollection();
        $this->exports = new ArrayCollection();
    }

    #[ORM\PreUpdate]
    public function setUpdatedAtValue(): void { $this->updatedAt = new \DateTimeImmutable(); }

    public function getId(): ?int { return $this->id; }
    public function getTitle(): ?string { return $this->title; }
    public function setTitle(string $title): static { $this->title = $title; return $this; }
    public function getStatus(): ProjectStatus { return $this->status; }
    public function setStatus(ProjectStatus $status): static { $this->status = $status; return $this; }
    public function getOwner(): ?User { return $this->owner; }
    public function setOwner(User $owner): static { $this->owner = $owner; return $this; }
    public function getCustomer(): ?Customer { return $this->customer; }
    public function setCustomer(Customer $customer): static { $this->customer = $customer; return $this; }
    public function getEvent(): ?Event { return $this->event; }
    public function setEvent(Event $event): static { $this->event = $event; return $this; }

    public function getCustomerLink(): ?CustomerLink { return $this->customerLink; }
    public function setCustomerLink(?CustomerLink $customerLink): static
    {
        if ($customerLink !== null && $customerLink->getProject() !== $this) {
            $customerLink->setProject($this);
        }
        $this->customerLink = $customerLink;
        return $this;
    }

    public function getDesign(): ?Design { return $this->design; }
    public function setDesign(?Design $design): static
    {
        if ($design !== null && $design->getProject() !== $this) {
            $design->setProject($this);
        }
        $this->design = $design;
        return $this;
    }

    /** @return Collection<int, ApprovalLog> */
    public function getApprovalLogs(): Collection { return $this->approvalLogs; }
    public function addApprovalLog(ApprovalLog $approvalLog): static
    {
        if (!$this->approvalLogs->contains($approvalLog)) {
            $this->approvalLogs->add($approvalLog);
            $approvalLog->setProject($this);
        }
        return $this;
    }

    /** @return Collection<int, Export> */
    public function getExports(): Collection { return $this->exports; }
    public function addExport(Export $export): static
    {
        if (!$this->exports->contains($export)) {
            $this->exports->add($export);
            $export->setProject($this);
        }
        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable { return $this->createdAt; }
    public function getUpdatedAt(): \DateTimeImmutable { return $this->updatedAt; }
}
