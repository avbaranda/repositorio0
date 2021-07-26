<?php

namespace App\Controller;

use App\Entity\Editoriales;
use App\Repository\EditorialesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/public/editorial', name: 'editorial')]
class EditorialController extends AbstractController
{

    #[Route('/', name: '')]
    public function index(EditorialesRepository $buscador): Response
    {
        $editoriales = $buscador->findAll();

        return $this->render('editorial/index.html.twig', [
            'editoriales' => $editoriales
        ]);
    }

    #[Route('/nuevo', name: '_nuevo')]
    public function nuevo(): Response
    {
        return $this->render('editorial/nuevo.html.twig');
    }

    #[Route('/{id}', name: '_lectura')]
    public function lectura($id, EditorialesRepository $buscador): Response
    {
        $editorial = $buscador->find($id);

        return $this->render('editorial/lectura.html.twig', [
            'editorial' => $editorial
        ]);
    }

    #[Route('/{id}/escritura', name: '_escritura')]
    public function escritura($id, EditorialesRepository $buscador): Response
    {
        $editorial = $buscador->find($id);

        return $this->render('editorial/escritura.html.twig', [
            'editorial' => $editorial
        ]);
    }

    #[Route('/crear', name: '_crear')]
    public function crear(
        Request $request,
        EntityManagerInterface $gestor
        ): Response
    {
        $editorial = new Editoriales();

        $nombre = $request->request->get('nombre');
        $editorial->setNombre($nombre);

        $gestor->persist($editorial);
        $gestor->flush();
        
        return $this->redirectToRoute("editorial");
    }

    #[Route('/modificar', name: '_modificar')]
    public function modificar(
        Request $request,
        EditorialesRepository $buscador,
        EntityManagerInterface $gestor
        ): Response
    {
        $id = $request->request->get('id');
        $editorial = $buscador->find($id);

        $nombre = $request->request->get('nombre');
        $editorial->setNombre($nombre);

        $gestor->persist($editorial);
        $gestor->flush();

        return $this->redirectToRoute("editorial_lectura", [$editorial->getId()]);
    }

    #[Route('/eliminar', name: '_eliminar')]
    public function eliminar(
        $id,
        EditorialesRepository $buscador,
        EntityManagerInterface $gestor
        ): Response
    {
        $editorial = $buscador->find($id);

        $gestor->remove($editorial);
        $gestor->flush();

        return $this->redirectToRoute("editorial");
    }

}
