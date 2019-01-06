<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
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
    private $path;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Category", mappedBy="image")
     */
    private $element;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Textbook", mappedBy="image")
     */
    private $textbooks;

    public function __construct()
    {
        $this->element = new ArrayCollection();
        $this->textbooks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getElement(): Collection
    {
        return $this->element;
    }

    public function addElement(Category $element): self
    {
        if (!$this->element->contains($element)) {
            $this->element[] = $element;
            $element->setImage($this);
        }

        return $this;
    }

    public function removeElement(Category $element): self
    {
        if ($this->element->contains($element)) {
            $this->element->removeElement($element);
            // set the owning side to null (unless already changed)
            if ($element->getImage() === $this) {
                $element->setImage(null);
            }
        }

        return $this;
    }

    public function getPathName(): ?string
    {
        return $this->getPath().$this->getName();
    }

    /**
     * @return Collection|Textbook[]
     */
    public function getTextbooks(): Collection
    {
        return $this->textbooks;
    }

    public function addTextbook(Textbook $textbook): self
    {
        if (!$this->textbooks->contains($textbook)) {
            $this->textbooks[] = $textbook;
            $textbook->setImage($this);
        }

        return $this;
    }

    public function removeTextbook(Textbook $textbook): self
    {
        if ($this->textbooks->contains($textbook)) {
            $this->textbooks->removeElement($textbook);
            // set the owning side to null (unless already changed)
            if ($textbook->getImage() === $this) {
                $textbook->setImage(null);
            }
        }

        return $this;
    }
}
