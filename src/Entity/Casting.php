<?php

namespace App\Entity;

use App\Repository\CastingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CastingRepository::class)]
class Casting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Movie>
     */
    #[ORM\ManyToMany(targetEntity: Movie::class, inversedBy: 'castings')]
    private Collection $movie;

    /**
     * @var Collection<int, Comedian>
     */
    #[ORM\ManyToMany(targetEntity: Comedian::class, inversedBy: 'castings')]
    private Collection $comedian;

    /**
     * @var Collection<int, Role>
     */
    #[ORM\ManyToMany(targetEntity: Role::class, inversedBy: 'castings')]
    private Collection $role;

    public function __construct()
    {
        $this->movie = new ArrayCollection();
        $this->comedian = new ArrayCollection();
        $this->role = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Movie>
     */
    public function getMovie(): Collection
    {
        return $this->movie;
    }

    public function addMovie(Movie $movie): static
    {
        if (!$this->movie->contains($movie)) {
            $this->movie->add($movie);
        }

        return $this;
    }

    public function removeMovie(Movie $movie): static
    {
        $this->movie->removeElement($movie);

        return $this;
    }

    /**
     * @return Collection<int, Comedian>
     */
    public function getComedian(): Collection
    {
        return $this->comedian;
    }

    public function addComedian(Comedian $comedian): static
    {
        if (!$this->comedian->contains($comedian)) {
            $this->comedian->add($comedian);
        }

        return $this;
    }

    public function removeComedian(Comedian $comedian): static
    {
        $this->comedian->removeElement($comedian);

        return $this;
    }

    /**
     * @return Collection<int, Role>
     */
    public function getRole(): Collection
    {
        return $this->role;
    }

    public function addRole(Role $role): static
    {
        if (!$this->role->contains($role)) {
            $this->role->add($role);
        }

        return $this;
    }

    public function removeRole(Role $role): static
    {
        $this->role->removeElement($role);

        return $this;
    }
}
