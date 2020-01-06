<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoriesRepository")
 */
class Categories
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categories", inversedBy="categoryChild")
     */
    private $categoryParent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Categories", mappedBy="categoryParent")
     */
    private $categoryChild;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titleCategory;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PostSujet", mappedBy="topic")
     */
    private $postSujets;

    public function __construct()
    {
        $this->categoryChild = new ArrayCollection();
        $this->postSujets = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTitleCategory();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryParent(): ?self
    {
        return $this->categoryParent;
    }

    public function setCategoryParent(?self $categoryParent): self
    {
        $this->categoryParent = $categoryParent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getCategoryChild(): Collection
    {
        return $this->categoryChild;
    }

    public function addCategoryChild(self $categoryChild): self
    {
        if (!$this->categoryChild->contains($categoryChild)) {
            $this->categoryChild[] = $categoryChild;
            $categoryChild->setCategoryParent($this);
        }

        return $this;
    }

    public function removeCategoryChild(self $categoryChild): self
    {
        if ($this->categoryChild->contains($categoryChild)) {
            $this->categoryChild->removeElement($categoryChild);
            // set the owning side to null (unless already changed)
            if ($categoryChild->getCategoryParent() === $this) {
                $categoryChild->setCategoryParent(null);
            }
        }

        return $this;
    }

    public function getTitleCategory(): ?string
    {
        return $this->titleCategory;
    }

    public function setTitleCategory(string $titleCategory): self
    {
        $this->titleCategory = $titleCategory;

        return $this;
    }

    /**
     * @return Collection|PostSujet[]
     */
    public function getPostSujets(): Collection
    {
        return $this->postSujets;
    }

    public function addPostSujet(PostSujet $postSujet): self
    {
        if (!$this->postSujets->contains($postSujet)) {
            $this->postSujets[] = $postSujet;
            $postSujet->setTopic($this);
        }

        return $this;
    }

    public function removePostSujet(PostSujet $postSujet): self
    {
        if ($this->postSujets->contains($postSujet)) {
            $this->postSujets->removeElement($postSujet);
            // set the owning side to null (unless already changed)
            if ($postSujet->getTopic() === $this) {
                $postSujet->setTopic(null);
            }
        }

        return $this;
    }
    
}
