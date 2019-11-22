<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PictureRepository")
 */
class Picture
{
    /** 
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Event", inversedBy="pictures")
     * @ORM\JoinColumn(nullable=true)
     */
    private $event;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Header", inversedBy="pictures")
     */
    private $header;

    public function __construct()
    {
        $this->header = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection|Header[]
     */
    public function getHeader(): Collection
    {
        return $this->header;
    }

    public function addHeader(Header $header): self
    {
        if (!$this->header->contains($header)) {
            $this->header[] = $header;
        }

        return $this;
    }

    public function removeHeader(Header $header): self
    {
        if ($this->header->contains($header)) {
            $this->header->removeElement($header);
        }

        return $this;
    }

}
