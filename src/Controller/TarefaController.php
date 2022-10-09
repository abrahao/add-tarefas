<?php

namespace App\Controller;

use App\Entity\Tarefa;
use App\Form\TarefaType;
use App\Repository\TarefaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tarefa')]
class TarefaController extends AbstractController
{
    #[Route('/', name: 'app_tarefa_index', methods: ['GET'])]
    public function index(TarefaRepository $tarefaRepository): Response
    {
        return $this->render('tarefa/index.html.twig', [
            'tarefas' => $tarefaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tarefa_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TarefaRepository $tarefaRepository): Response
    {
        $tarefa = new Tarefa();
        $form = $this->createForm(TarefaType::class, $tarefa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tarefaRepository->save($tarefa, true);

            return $this->redirectToRoute('app_tarefa_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tarefa/new.html.twig', [
            'tarefa' => $tarefa,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tarefa_show', methods: ['GET'])]
    public function show(Tarefa $tarefa): Response
    {
        return $this->render('tarefa/show.html.twig', [
            'tarefa' => $tarefa,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tarefa_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tarefa $tarefa, TarefaRepository $tarefaRepository): Response
    {
        $form = $this->createForm(TarefaType::class, $tarefa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tarefaRepository->save($tarefa, true);

            return $this->redirectToRoute('app_tarefa_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tarefa/edit.html.twig', [
            'tarefa' => $tarefa,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tarefa_delete', methods: ['POST'])]
    public function delete(Request $request, Tarefa $tarefa, TarefaRepository $tarefaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tarefa->getId(), $request->request->get('_token'))) {
            $tarefaRepository->remove($tarefa, true);
        }

        return $this->redirectToRoute('app_tarefa_index', [], Response::HTTP_SEE_OTHER);
    }
}
