<?php

declare(strict_types = 1);

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class User
{
    /**
     * @ORM\Column(type = "integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity = "UploadedFile")
     * @ORM\JoinColumn(nullable = true)
     */
    protected $lastUploadedFile;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setLastUploadedFile(UploadedFile $lastUploadedFile): self
    {
        $this->lastUploadedFile = $lastUploadedFile;

        return $this;
    }

    public function getLastUploadedFile(): ?UploadedFile
    {
        return $this->lastUploadedFile;
    }
}
