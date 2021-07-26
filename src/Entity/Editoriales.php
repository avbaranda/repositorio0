<?php

namespace App\Entity;

use App\Repository\EditorialesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EditorialesRepository::class)
 */
class Editoriales
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $Nombre;

    /**
     * @ORM\OneToMany(targetEntity=Libros::class, mappedBy="editorial")
     */
    private $libros;

    public function __construct()
    {
        $this->libros = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(?string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    /**
     * @return Collection|Libros[]
     */
    public function getLibros(): Collection
    {
        return $this->libros;
    }

    public function addLibro(Libros $libro): self
    {
        if (!$this->libros->contains($libro)) {
            $this->libros[] = $libro;
            $libro->setEditorial($this);
        }

        return $this;
    }

    public function removeLibro(Libros $libro): self
    {
        if ($this->libros->removeElement($libro)) {
            // set the owning side to null (unless already changed)
            if ($libro->getEditorial() === $this) {
                $libro->setEditorial(null);
            }
        }

        return $this;
    }
}
