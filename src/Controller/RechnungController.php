<?php

namespace App\Controller;

use App\Entity\Rechnung;
use App\Form\RechnungType;
use App\Repository\RechnungRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/rechnung')]
class RechnungController extends AbstractController
{
    #[Route('/', name: 'app_rechnung_index', methods: ['GET'])]
    public function index(RechnungRepository $rechnungRepository): Response
    {
        return $this->render('rechnung/index.html.twig', [
            'rechnungs' => $rechnungRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_rechnung_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RechnungRepository $rechnungRepository): Response
    {
        $rechnung = new Rechnung();
        $form = $this->createForm(RechnungType::class, $rechnung);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rechnungRepository->save($rechnung, true);

            return $this->redirectToRoute('app_rechnung_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rechnung/new.html.twig', [
            'rechnung' => $rechnung,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rechnung_show', methods: ['GET'])]
    public function show(Rechnung $rechnung): Response
    {
        return $this->render('rechnung/show.html.twig', [
            'rechnung' => $rechnung,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_rechnung_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Rechnung $rechnung, RechnungRepository $rechnungRepository): Response
    {
        $form = $this->createForm(RechnungType::class, $rechnung);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rechnungRepository->save($rechnung, true);

            return $this->redirectToRoute('app_rechnung_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rechnung/edit.html.twig', [
            'rechnung' => $rechnung,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rechnung_delete', methods: ['POST'])]
    public function delete(Request $request, Rechnung $rechnung, RechnungRepository $rechnungRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rechnung->getId(), $request->request->get('_token'))) {
            $rechnungRepository->remove($rechnung, true);
        }

        return $this->redirectToRoute('app_rechnung_index', [], Response::HTTP_SEE_OTHER);
    }
}
