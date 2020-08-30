<?php

namespace App\Entity;

use App\Repository\AdventureRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdventureRepository", repositoryClass=AdventureRepository::class)
 */
class Adventure
{
    public const TYPE_HIKING = 'Hiking';
    public const TYPE_SKIING = 'Skiing';
    public const TYPE_SURFING = 'Surfing';
    public const TYPE_SWIMMING = 'Swimming';
    public const TYPE_SNOWBOARDING = 'Snowboarding';
    public const TYPE_RIDING = 'Riding';
    public const TYPE_SAILING = 'Sailing';

    use TimestampableEntity;


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Location;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *     max = 255
     * )
     */
    private $Type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocation(): ?string
    {
        return $this->Location;
    }

    public function setLocation(string $Location): self
    {
        $this->Location = $Location;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }
}
