<?php

namespace App\Services;

use App\Entity\Autores;
use App\Repository\AutoresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AutorServices
{

    public function mutarAutor(
        Request $request,
        Autores $autor
        ): Autores
    {
        $nombre = $request->request->get('nombre');
        $autor->setNombre($nombre);
        $tipo = $request->request->get('tipo');
        $autor->setTipo($tipo);

        return $autor;
    }

    public function construirAutor(
        Request $request
        ): Autores
    {
        return $this->mutarAutor($request, new Autores());
    }

}
