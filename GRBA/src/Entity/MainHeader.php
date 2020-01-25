<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MainHeaderRepository")
 */
class MainHeader
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
    private $image1;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $textImage1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image2;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $textImage2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image3;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $textImage3;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage1(): ?string
    {
        return $this->image1;
    }

    public function setImage1(string $image1): self
    {
        $this->image1 = $image1;

        return $this;
    }

    public function getTextImage1(): ?string
    {
        return $this->textImage1;
    }

    public function setTextImage1(?string $textImage1): self
    {
        $this->textImage1 = $textImage1;

        return $this;
    }

    public function getImage2(): ?string
    {
        return $this->image2;
    }

    public function setImage2(?string $image2): self
    {
        $this->image2 = $image2;

        return $this;
    }

    public function getTextImage2(): ?string
    {
        return $this->textImage2;
    }

    public function setTextImage2(?string $textImage2): self
    {
        $this->textImage2 = $textImage2;

        return $this;
    }

    public function getImage3(): ?string
    {
        return $this->image3;
    }

    public function setImage3(?string $image3): self
    {
        $this->image3 = $image3;

        return $this;
    }

    public function getTextImage3(): ?string
    {
        return $this->textImage3;
    }

    public function setTextImage3(?string $textImage3): self
    {
        $this->textImage3 = $textImage3;

        return $this;
    }

    
}
