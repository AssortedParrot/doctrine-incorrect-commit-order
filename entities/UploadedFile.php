<?php

declare(strict_types = 1);

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class UploadedFile
{
    /**
     * @ORM\Column(type = "integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity = "User")
     * @ORM\JoinColumn(nullable = false)
     */
    protected $owner;

    /**
     * @ORM\OneToOne(targetEntity = "User")
     * @ORM\JoinColumn(nullable = true)
     */
    protected $lastDownloadedBy;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setOwner(User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setLastDownloadedBy(User $lastDownloadedBy): self
    {
        $this->lastDownloadedBy = $lastDownloadedBy;

        return $this;
    }

    public function getLastDownloadedBy(): ?User
    {
        return $this->lastDownloadedBy;
    }
}
