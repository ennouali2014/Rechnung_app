<?php

namespace App\Controller;

use App\Entity\Ansteller;
use App\Form\AnstellerType;
use App\Repository\AnstellerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ansteller')]
class AnstellerController extends AbstractController
{
    #[Route('/', name: 'app_ansteller_index', methods: ['GET'])]
    public function index(AnstellerRepository $anstellerRepository): Response
    {
        return $this->render('ansteller/index.html.twig', [
            'anstellers' => $anstellerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ansteller_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AnstellerRepository $anstellerRepository): Response
    {
        $ansteller = new Ansteller();
        $form = $this->createForm(AnstellerType::class, $ansteller);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $anstellerRepository->save($ansteller, true);

            return $this->redirectToRoute('app_ansteller_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ansteller/new.html.twig', [
            'ansteller' => $ansteller,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ansteller_show', methods: ['GET'])]
    public function show(Ansteller $ansteller): Response
    {
        return $this->render('ansteller/show.html.twig', [
            'ansteller' => $ansteller,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ansteller_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ansteller $ansteller, AnstellerRepository $anstellerRepository): Response
    {
        $form = $this->createForm(AnstellerType::class, $ansteller);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $anstellerRepository->save($ansteller, true);

            return $this->redirectToRoute('app_ansteller_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ansteller/edit.html.twig', [
            'ansteller' => $ansteller,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ansteller_delete', methods: ['POST'])]
    public function delete(Request $request, Ansteller $ansteller, AnstellerRepository $anstellerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ansteller->getId(), $request->request->get('_token'))) {
            $anstellerRepository->remove($ansteller, true);
        }

        return $this->redirectToRoute('app_ansteller_index', [], Response::HTTP_SEE_OTHER);
    }
}
