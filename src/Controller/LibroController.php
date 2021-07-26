<?php

namespace App\Controller;

use App\Entity\Editoriales;
use App\Entity\Libros;
use App\Repository\AutoresRepository;
use App\Repository\EditorialesRepository;
use App\Repository\LibrosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/public/libro', name: 'libro')]
class LibroController extends AbstractController
{

    #[Route('/', name: '')]
    public function index(LibrosRepository $buscador): Response
    {
        $libros = $buscador->findAll();

        return $this->render('libro/index.html.twig', [
            'libros' => $libros
        ]);
    }

    #[Route('/nuevo', name: '_nuevo')]
    public function nuevo(): Response
    {
        return $this->render('libro/nuevo.html.twig');
    }

    #[Route('/{id}', name: '_lectura')]
    public function lectura($id, LibrosRepository $buscador): Response
    {
        $libro = $buscador->find($id);

        return $this->render('libro/lectura.html.twig', [
            'libro' => $libro
        ]);
    }

    #[Route('/{id}/escritura', name: '_escritura')]
    public function escritura($id, LibrosRepository $buscador): Response
    {
        $libro = $buscador->find($id);

        return $this->render('libro/escritura.html.twig', [
            'libro' => $libro
        ]);
    }

    #[Route('/crear', name: '_crear')]
    public function crear(
        Request $request,
        EditorialesRepository $buscadorEditoriales,
        AutoresRepository $buscadorAutores,
        EntityManagerInterface $gestor
        ): Response
    {
        $libro = new Libros();
        
        $titulo = $request->request->get('titulo');
        $libro->setTitulo($titulo);

        $isbn = $request->request->get('isbn');
        $libro->setISBN($isbn);

        $edicion = $request->request->get('edicion');
        $libro->setEdicion($edicion);

        $publicacion = $request->request->get('publicacion');
        $libro->setPublicacion($publicacion);

        $categoria = $request->request->get('categoria');
        $libro->setCategoria($categoria);

        $editorialId = $request->request->get('editorialId');
        $editorial = $buscadorEditoriales->find($editorialId);
        $libro->setEditorial($editorial);

        /* TODO iterar el string
        foreach ($autoresId as $id) {
            $autor = $gestorEntidades->getRepository('AutoresRepository')->find($id);
            $libro->addAutor($autor);
        }
        */

        $gestor->persist($libro);
        $gestor->flush();
        
        return $this->redirectToRoute("libro");
    }

    #[Route('/modificar', name: '_modificar')]
    public function modificar(
        Request $request,
        LibrosRepository $buscadorLibros,
        EditorialesRepository $buscadorEditoriales,
        AutoresRepository $buscadorAutores,
        EntityManagerInterface $gestor
        ): Response
    {
        $id = $request->request->get('id');
        $libro = $buscadorLibros->find($id);

        $titulo = $request->request->get('titulo');
        $libro->setTitulo($titulo);

        $isbn = $request->request->get('isbn');
        $libro->setISBN($isbn);

        $edicion = $request->request->get('edicion');
        $libro->setEdicion($edicion);

        $publicacion = $request->request->get('publicacion');
        $libro->setPublicacion($publicacion);

        $categoria = $request->request->get('categoria');
        $libro->setCategoria($categoria);

        $editorialId = $request->request->get('editorialId');
        $editorial = $buscadorEditoriales->find($editorialId);
        $libro->setEditorial($editorial);

        $autoresId = $request->request->get('autoresId');
        // Convertir en una coleccion de ids
        // (A)
        // Convertir en una coleccion de autores
        // (B)
        $autores = $libro->getAutores();
        // (B) -= (B) - (A)
        // Eliminar de $autores los autores que NO estén en (A)
        // (B) += (A)
        // Añadir en $autores (A)

        /*
        foreach ($autoresId as $id) {
            $autor = $buscadorAutores->find($id);
            $libro->addAutor($autor);
        }
        */

        $gestor->persist($libro);
        $gestor->flush();

        return $this->redirectToRoute("libro_lectura", [$libro->getId()]);
    }

    #[Route('/eliminar', name: '_eliminar')]
    public function eliminar(
        $id,
        LibrosRepository $buscador,
        EntityManagerInterface $gestor
        ): Response
    {
        $libro = $buscador->find($id);

        $gestor->remove($libro);
        $gestor->flush();

        return $this->redirectToRoute("libro");
    }

}
