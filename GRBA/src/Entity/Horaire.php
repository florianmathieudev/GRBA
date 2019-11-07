<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HoraireRepository")
 */
class Horaire
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
    private $opening;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $closing;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $open;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOpening(): ?string
    {
        return $this->opening;
    }

    public function setOpening(string $opening): self
    {
        $this->opening = $opening;

        return $this;
    }

    public function getClosing(): ?string
    {
        return $this->closing;
    }

    public function setClosing(string $closing): self
    {
        $this->closing = $closing;

        return $this;
    }

    public function getOpen(): ?bool
    {
        return $this->open;
    }

    public function setOpen(?bool $open): self
    {
        $this->open = $open;

        return $this;
    }
}
