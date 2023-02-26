<?php

namespace App\Controller;

use App\Entity\Kunde;
use App\Form\KundeType;
use App\Repository\KundeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/kunde')]
class KundeController extends AbstractController
{
    #[Route('/', name: 'app_kunde_index', methods: ['GET'])]
    public function index(KundeRepository $kundeRepository): Response
    {
        return $this->render('kunde/index.html.twig', [
            'kundes' => $kundeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_kunde_new', methods: ['GET', 'POST'])]
    public function new(Request $request, KundeRepository $kundeRepository): Response
    {
        $kunde = new Kunde();
        $form = $this->createForm(KundeType::class, $kunde);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $kundeRepository->save($kunde, true);

            return $this->redirectToRoute('app_kunde_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('kunde/new.html.twig', [
            'kunde' => $kunde,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_kunde_show', methods: ['GET'])]
    public function show(Kunde $kunde): Response
    {
        return $this->render('kunde/show.html.twig', [
            'kunde' => $kunde,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_kunde_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Kunde $kunde, KundeRepository $kundeRepository): Response
    {
        $form = $this->createForm(KundeType::class, $kunde);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $kundeRepository->save($kunde, true);

            return $this->redirectToRoute('app_kunde_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('kunde/edit.html.twig', [
            'kunde' => $kunde,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_kunde_delete', methods: ['POST'])]
    public function delete(Request $request, Kunde $kunde, KundeRepository $kundeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$kunde->getId(), $request->request->get('_token'))) {
            $kundeRepository->remove($kunde, true);
        }

        return $this->redirectToRoute('app_kunde_index', [], Response::HTTP_SEE_OTHER);
    }
}
