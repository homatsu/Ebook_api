<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
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
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Textbook", mappedBy="category")
     */
    private $textbooks;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Image", inversedBy="element")
     */
    private $image;

    public function __construct()
    {
        $this->textbooks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
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
            $textbook->setCategory($this);
        }

        return $this;
    }

    public function removeTextbook(Textbook $textbook): self
    {
        if ($this->textbooks->contains($textbook)) {
            $this->textbooks->removeElement($textbook);
            // set the owning side to null (unless already changed)
            if ($textbook->getCategory() === $this) {
                $textbook->setCategory(null);
            }
        }

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        $this->image = $image;

        return $this;
    }
}
