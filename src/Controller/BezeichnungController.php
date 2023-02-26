<?php

namespace App\Controller;

use App\Entity\Bezeichnung;
use App\Form\BezeichnungType;
use App\Repository\BezeichnungRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bezeichnung')]
class BezeichnungController extends AbstractController
{
    #[Route('/', name: 'app_bezeichnung_index', methods: ['GET'])]
    public function index(BezeichnungRepository $bezeichnungRepository): Response
    {
        return $this->render('bezeichnung/index.html.twig', [
            'bezeichnungs' => $bezeichnungRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bezeichnung_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BezeichnungRepository $bezeichnungRepository): Response
    {
        $bezeichnung = new Bezeichnung();
        $form = $this->createForm(BezeichnungType::class, $bezeichnung);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bezeichnungRepository->save($bezeichnung, true);

            return $this->redirectToRoute('app_bezeichnung_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bezeichnung/new.html.twig', [
            'bezeichnung' => $bezeichnung,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bezeichnung_show', methods: ['GET'])]
    public function show(Bezeichnung $bezeichnung): Response
    {
        return $this->render('bezeichnung/show.html.twig', [
            'bezeichnung' => $bezeichnung,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bezeichnung_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bezeichnung $bezeichnung, BezeichnungRepository $bezeichnungRepository): Response
    {
        $form = $this->createForm(BezeichnungType::class, $bezeichnung);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bezeichnungRepository->save($bezeichnung, true);

            return $this->redirectToRoute('app_bezeichnung_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bezeichnung/edit.html.twig', [
            'bezeichnung' => $bezeichnung,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bezeichnung_delete', methods: ['POST'])]
    public function delete(Request $request, Bezeichnung $bezeichnung, BezeichnungRepository $bezeichnungRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bezeichnung->getId(), $request->request->get('_token'))) {
            $bezeichnungRepository->remove($bezeichnung, true);
        }

        return $this->redirectToRoute('app_bezeichnung_index', [], Response::HTTP_SEE_OTHER);
    }
}
