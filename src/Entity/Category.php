<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"},
 *     normalizationContext={"groups"={"category:get"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"category:get"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"category:get"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Techno", mappedBy="category")
     * @Groups({"category:get"})
     */
    private $Technos;

    public function __construct()
    {
        $this->Technos = new ArrayCollection();
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
     * @return Collection|Techno[]
     */
    public function getTechnos(): Collection
    {
        return $this->Technos;
    }

    public function addTechno(Techno $techno): self
    {
        if (!$this->Technos->contains($techno)) {
            $this->Technos[] = $techno;
            $techno->setCategory($this);
        }

        return $this;
    }

    public function removeTechno(Techno $techno): self
    {
        if ($this->Technos->contains($techno)) {
            $this->Technos->removeElement($techno);
            // set the owning side to null (unless already changed)
            if ($techno->getCategory() === $this) {
                $techno->setCategory(null);
            }
        }

        return $this;
    }
}
