<?php

namespace App\Entity;

use App\Entity\Property;
use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\PropertyTypesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PropertyTypesRepository::class)]
#[ApiResource(

    operations: [
        new Get(normalizationContext: ['groups' => 'propertytype:item']),
        new Get(normalizationContext: ['groups' => 'property:item']),
        new Get(normalizationContext: ['groups' => 'property:list']),
        new GetCollection(normalizationContext: ['groups' => 'propertytype:list'])
    ],
    order: ['entitled' => 'DESC'],
    paginationEnabled: false,
)]

class PropertyTypes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['propertytype:list', 'propertytype:item'])]

    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['propertytype:list', 'propertytype:item', 'property:list', 'property:item'])]
    private ?string $entitled = null;

    #[ORM\OneToMany(mappedBy: 'property_types', targetEntity: Property::class)]
    private Collection $properties;

    public function __construct()
    {
        $this->properties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntitled(): ?string
    {
        return $this->entitled;
    }

    public function setEntitled(string $entitled): self
    {
        $this->entitled = $entitled;

        return $this;
    }

    /**
     * @return Collection<int, Property>
     */
    public function getProperties(): Collection
    {
        return $this->properties;
    }

    public function addProperty(Property $property): self
    {
        if (!$this->properties->contains($property)) {
            $this->properties->add($property);
            $property->setPropertyTypes($this);
        }

        return $this;
    }

    public function removeProperty(Property $property): self
    {
        if ($this->properties->removeElement($property)) {
            // set the owning side to null (unless already changed)
            if ($property->getPropertyTypes() === $this) {
                $property->setPropertyTypes(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->entitled;
    }
}