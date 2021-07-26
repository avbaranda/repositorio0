<?php

namespace App\Entity;

use App\Repository\LibrosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LibrosRepository::class)
 */
class Libros
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    private $Titulo;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $ISBN;

    /**
     * @ORM\Column(type="string", length=4, nullable=true)
     */
    private $Edicion;

    /**
     * @ORM\Column(type="string", length=4, nullable=true)
     */
    private $Publicacion;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $Categoria;

    /**
     * @ORM\ManyToOne(targetEntity=Editoriales::class, inversedBy="libros")
     */
    private $editorial;

    /**
     * @ORM\ManyToMany(targetEntity=Autores::class, inversedBy="libros")
     */
    private $autores;

    public function __construct()
    {
        $this->Autores = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->Titulo;
    }

    public function setTitulo(?string $Titulo): self
    {
        $this->Titulo = $Titulo;

        return $this;
    }

    public function getISBN(): ?string
    {
        return $this->ISBN;
    }

    public function setISBN(?string $ISBN): self
    {
        $this->ISBN = $ISBN;

        return $this;
    }

    public function getEdicion(): ?string
    {
        return $this->Edicion;
    }

    public function setEdicion(?string $Edicion): self
    {
        $this->Edicion = $Edicion;

        return $this;
    }

    public function getPublicacion(): ?string
    {
        return $this->Publicacion;
    }

    public function setPublicacion(?string $Publicacion): self
    {
        $this->Publicacion = $Publicacion;

        return $this;
    }

    public function getCategoria(): ?string
    {
        return $this->Categoria;
    }

    public function setCategoria(?string $Categoria): self
    {
        $this->Categoria = $Categoria;

        return $this;
    }

    public function getEditorial(): ?Editoriales
    {
        return $this->Editoriales;
    }

    public function setEditorial(?Editoriales $Editorial): self
    {
        $this->Editoriales = $Editorial;

        return $this;
    }

    /**
     * @return Collection|Autores[]
     */
    public function getAutores(): Collection
    {
        return $this->Autores;
    }

    public function setAutores(Collection $Autores): self
    {
        return $this->Autores = $Autores;

        return $this;
    }

    public function addAutor(Autores $autor): self
    {
        if (!$this->Autores->contains($autor)) {
            $this->Autores[] = $autor;
        }

        return $this;
    }

    public function removeAutor(Autores $autor): self
    {
        $this->Autores->removeElement($autor);

        return $this;
    }
}
