<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event
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
    private $place;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Picture", mappedBy="event")
     */
    private $pictures;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\File", mappedBy="event")
     */
    private $files;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Picture2", mappedBy="event")
     */
    private $picture2s;


    public function __construct()
    {
        $this->pictures = new ArrayCollection();
        $this->files = new ArrayCollection();
        $this->picture2s = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {  
        if (!$this->pictures->contains($picture)) {
            
            $this->pictures[] = $picture;
            $picture->setEvent($this);
        }

        return $this;
    }

    public function removeAllPicture(): self
    {
        foreach ($this->pictures as $picture) {
            $this->pictures->removeElement($picture);
            
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->contains($picture)) {
            $this->pictures->removeElement($picture);
            // set the owning side to null (unless already changed)
            if ($picture->getEvent() === $this) {
                $picture->setEvent(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->place;
    }    
    

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }

    /**
     * @return Collection|File[]
     */
    public function getFiles(): Collection
    {
        return $this->files;
    }

    public function addFile(File $file): self
    {
        if (!$this->files->contains($file)) {
            $this->files[] = $file;
            $file->setEvent($this);
        }

        return $this;
    }

    public function removeFile(File $file): self
    {
        if ($this->files->contains($file)) {
            $this->files->removeElement($file);
            // set the owning side to null (unless already changed)
            if ($file->getEvent() === $this) {
                $file->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Picture2[]
     */
    public function getPicture2s(): Collection
    {
        return $this->picture2s;
    }

    public function addPicture2(Picture2 $picture2): self
    {
        if (!$this->picture2s->contains($picture2)) {
            $this->picture2s[] = $picture2;
            $picture2->setEvent($this);
        }

        return $this;
    }

    public function removePicture2(Picture2 $picture2): self
    {
        if ($this->picture2s->contains($picture2)) {
            $this->picture2s->removeElement($picture2);
            // set the owning side to null (unless already changed)
            if ($picture2->getEvent() === $this) {
                $picture2->setEvent(null);
            }
        }

        return $this;
    }
}
