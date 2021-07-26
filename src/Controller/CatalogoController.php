<?php

namespace App\Controller;

use App\FakeData\Catalogo;
use App\Repository\LibrosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/catalogo', name: 'catalogo')]
class CatalogoController extends AbstractController
{
    #[Route('/', name: '')]
    public function index(LibrosRepository $librosR): Response
    {
        
        // $fondos = Catalogo::$fondos;
        
        $fondos = $librosR->findAll();

        return $this->render('catalogo/index.html.twig', [
            'fondos' => $fondos
        ]);
    }

    #[Route('/ver', name: '_ver')]
    public function ver($id, LibrosRepository $buscadorLibros): Response
    {
        
        $libro = $buscadorLibros->find($id);

        return $this->render('catalogo/ver.html.twig', [
            'libro' => $libro
        ]);
    }

    // añadir borrar y modificar
    // tras modificar presentar otra vez el listado de libros
    // reutilizando la acción index, es decir una redicción
    // codigo 302
    // ...

}
