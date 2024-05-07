<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cover = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pdf = null;

    #[ORM\OneToMany(mappedBy: 'book', targetEntity: ImageBook::class, cascade:["persist"])]
    private Collection $imageBooks;

    #[ORM\ManyToOne(inversedBy: 'books')]
    private ?CategoryBook $category = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avtor = null;

    public function __construct()
    {
        $this->imageBooks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): static
    {
        $this->cover = $cover;

        return $this;
    }

    public function getPdf(): ?string
    {
        return $this->pdf;
    }

    public function setPdf(string $pdf): static
    {
        $this->pdf = $pdf;

        return $this;
    }

    /**
     * @return Collection<int, ImageBook>
     */
    public function getImageBooks(): Collection
    {
        return $this->imageBooks;
    }

    public function addImageBook(ImageBook $imageBook): static
    {
        if (!$this->imageBooks->contains($imageBook)) {
            $this->imageBooks->add($imageBook);
            $imageBook->setBook($this);
        }

        return $this;
    }

    public function removeImageBook(ImageBook $imageBook): static
    {
        if ($this->imageBooks->removeElement($imageBook)) {
            // set the owning side to null (unless already changed)
            if ($imageBook->getBook() === $this) {
                $imageBook->setBook(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?CategoryBook
    {
        return $this->category;
    }

    public function setCategory(?CategoryBook $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getAvtor(): ?string
    {
        return $this->avtor;
    }

    public function setAvtor(?string $avtor): static
    {
        $this->avtor = $avtor;

        return $this;
    }
}
