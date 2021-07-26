<?php

namespace App\Entity;

use App\Repository\AutoresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AutoresRepository::class)
 */
class Autores
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
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $Tipo;

    /**
     * @ORM\ManyToMany(targetEntity=Libros::class, mappedBy="AutoresLibros")
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

    public function getTipo(): ?string
    {
        return $this->Tipo;
    }

    public function setTipo(?string $Tipo): self
    {
        $this->Tipo = $Tipo;

        return $this;
    }

    /**
     * @return Collection|Libros[]
     */
    public function getLibros(): Collection
    {
        return $this->Libros;
    }

    public function addLibro(Libros $libro): self
    {
        if (!$this->Libros->contains($libro)) {
            $this->Libros[] = $libro;
            $libro->addAutor($this);
        }

        return $this;
    }

    public function removeLibro(Libros $libro): self
    {
        if ($this->Libros->removeElement($libro)) {
            $libro->removeAutor($this);
        }

        return $this;
    }
}
