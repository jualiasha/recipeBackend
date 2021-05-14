<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 */
class Recipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
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
    private $img;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $prepTime;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $cookTime;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $serves;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $ingrnumber;

    /**
     * @ORM\Column(type="array")
     */
    private $ingredients = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @ORM\Column(type="array")
     */
    private $description = [];

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

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getPrepTime(): ?string
    {
        return $this->prepTime;
    }

    public function setPrepTime(string $prepTime): self
    {
        $this->prepTime = $prepTime;

        return $this;
    }

    public function getCookTime(): ?string
    {
        return $this->cookTime;
    }

    public function setCookTime(string $cookTime): self
    {
        $this->cookTime = $cookTime;

        return $this;
    }

    public function getServes(): ?string
    {
        return $this->serves;
    }

    public function setServes(string $serves): self
    {
        $this->serves = $serves;

        return $this;
    }

    public function getIngrnumber(): ?string
    {
        return $this->ingrnumber;
    }

    public function setIngrnumber(string $ingrnumber): self
    {
        $this->ingrnumber = $ingrnumber;

        return $this;
    }

    public function getIngredients(): ?array
    {
        return $this->ingredients;
    }

    public function setIngredients(array $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getDescription(): ?array
    {
        return $this->description;
    }

    public function setDescription(array $description): self
    {
        $this->description = $description;

        return $this;
    }
}
