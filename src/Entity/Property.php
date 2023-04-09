<?php

namespace App\Entity;

use App\Entity\Currency;
use App\Entity\Pictures;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Entity\AssertCurrency;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\PropertyRepository;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Currency as ConstraintsCurrency;

#[ORM\Entity(repositoryClass: PropertyRepository::class)]
#[ApiResource(
    operations: [
        new Post(normalizationContext: ['groups' => 'property:item']),
        new Get(normalizationContext: ['groups' => 'property:item']),
        new GetCollection(normalizationContext: ['groups' => 'property:list'])
    ],
    order: ['price' => 'ASC'],
    paginationEnabled: false,
)]
class Property
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['property:list', 'property:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['property:list', 'property:item'])]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Groups(['property:list', 'property:item'])]
    private ?string $summary = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    #[Groups(['property:list', 'property:item'])]
    private ?string $price = null;


    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $additional_address = null;

    #[ORM\Column]
    #[Groups(['property:list', 'property:item'])]
    private ?int $postcode = null;

    #[ORM\Column(length: 255)]
    #[Groups(['property:list', 'property:item'])]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    #[Groups(['property:list', 'property:item'])]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    #[Groups(['property:list', 'property:item'])]
    private ?string $place_displayed = null;

    #[ORM\Column]
    private ?int $gps_coordinate = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\Column(nullable: true)]
    private ?int $views = null;

    #[ORM\ManyToOne(inversedBy: 'properties')]
    #[Groups(['property:list', 'property:item'])]
    private ?PropertyTypes $property_types = null;

    #[ORM\ManyToOne(inversedBy: 'properties')]
    #[Groups(['property:list', 'property:item'])]
    private ?User $owner = null;

    #[ORM\ManyToOne(inversedBy: 'properties')]
    #[Groups(['property:list', 'property:item'])]
    private ?TransactionTypes $transaction_types = null;

    #[ORM\OneToMany(mappedBy: 'property', targetEntity: Pictures::class)]
    #[Groups(['property:list', 'property:item'])]
    private Collection $pictures;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getAdditionalAddress(): ?string
    {
        return $this->additional_address;
    }

    public function setAdditionalAddress(?string $additional_address): self
    {
        $this->additional_address = $additional_address;

        return $this;
    }

    public function getPostcode(): ?int
    {
        return $this->postcode;
    }

    public function setPostcode(int $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getPlaceDisplayed(): ?string
    {
        return $this->place_displayed;
    }

    public function setPlaceDisplayed(string $place_displayed): self
    {
        $this->place_displayed = $place_displayed;

        return $this;
    }

    public function getGpsCoordinate(): ?int
    {
        return $this->gps_coordinate;
    }

    public function setGpsCoordinate(int $gps_coordinate): self
    {
        $this->gps_coordinate = $gps_coordinate;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getViews(): ?int
    {
        return $this->views;
    }

    public function setViews(int $views): self
    {
        $this->views = $views;

        return $this;
    }

    public function getPropertyTypes(): ?PropertyTypes
    {
        return $this->property_types;
    }

    public function setPropertyTypes(?PropertyTypes $property_types): self
    {
        $this->property_types = $property_types;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getTransactionTypes(): ?TransactionTypes
    {
        return $this->transaction_types;
    }

    public function setTransactionTypes(?TransactionTypes $transaction_types): self
    {
        $this->transaction_types = $transaction_types;

        return $this;
    }

    /**
     * @return Collection<int, Pictures>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Pictures $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures->add($picture);
            $picture->setProperty($this);
        }

        return $this;
    }

    public function removePicture(Pictures $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getProperty() === $this) {
                $picture->setProperty(null);
            }
        }

        return $this;
    }
}