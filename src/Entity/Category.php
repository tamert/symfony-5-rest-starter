<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
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
     * @ORM\OneToMany(targetEntity="App\Entity\Post", mappedBy="Category")
     */
    private $Posts;

    public function __construct()
    {
        $this->Posts = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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

    /**
     * @return Collection|Post[]
     */
    public function getPosts(): Collection
    {
        return $this->Posts;
    }

    public function addPost(Post $Post): self
    {
        if (!$this->Posts->contains($Post)) {
            $this->Posts[] = $Post;
            $Post->setCategory($this);
        }

        return $this;
    }

    public function removePost(Post $Post): self
    {
        if ($this->Posts->contains($Post)) {
            $this->Posts->removeElement($Post);
            // set the owning side to null (unless already changed)
            if ($Post->getCategory() === $this) {
                $Post->setCategory(null);
            }
        }

        return $this;
    }
}
