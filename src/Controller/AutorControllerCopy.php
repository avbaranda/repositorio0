<?php

namespace App\Controller;

use App\Entity\Autores;
use App\Repository\AutoresRepository;
use App\Services\AutorServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/public/autor', name: 'autor')]
class AutorController extends AbstractController
{

    #[Route('/', name: '')]
    public function index(AutoresRepository $buscador): Response
    {
        $autores = $buscador->findAll();

        $numero = 1;
        $numero += 1;

        return $this->render('autor/index.html.twig', [
            'autores' => $autores
        ]);
    }

    #[Route('/nuevo', name: '_nuevo')]
    public function nuevo(): Response
    {
        return $this->render('autor/nuevo.html.twig');
    }

    #[Route('/{id}', name: '_lectura')]
    public function lectura($id, AutoresRepository $buscador): Response
    {
        $autor = $buscador->find($id);

        return $this->render('autor/lectura.html.twig', [
            'autor' => $autor
        ]);
    }

    #[Route('/{id}/escritura', name: '_escritura')]
    public function escritura($id, AutoresRepository $buscador): Response
    {
        $autor = $buscador->find($id);

        return $this->render('autor/escritura.html.twig', [
            'autor' => $autor
        ]);
    }

    #[Route('/crear', name: '_crear')]
    public function crear(
        Request $request,
        AutorServices $servicio,
        EntityManagerInterface $gestor
        ): Response
    {
        $gestor->persist($servicio->construirAutor($request));
        $gestor->flush();

        /*
        $id = $autor->getId();
        return $this->redirectToRoute("autor_lectura", ['id' => $id] );
        */
        
        return $this->redirectToRoute("autor");
    }

    #[Route('/modificar', name: '_modificar')]
    public function modificar(
        Request $request,
        AutoresRepository $buscador,
        AutorServices $servicio,
        EntityManagerInterface $gestor
        ): Response
    {
        $id = $request->request->get('id');
        $autor = $buscador->find($id);

        $gestor->persist($servicio->mutarAutor($request, $autor));
        $gestor->flush();

        return $this->redirectToRoute("autor_lectura", ['id' => $autor->getId()]);
    }

    #[Route('/eliminar', name: '_eliminar')]
    public function eliminar(
        $id,
        AutoresRepository $buscador,
        EntityManagerInterface $gestor
        ): Response
    {
        $autor = $buscador->find($id);

        $gestor->remove($autor);
        $gestor->flush();

        return $this->redirectToRoute("autor");
    }

}
