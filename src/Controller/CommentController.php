<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CommentController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {}

    #[Route('/comment', name: 'comment')]
    public function index(CommentRepository $commentRepository, Request $request): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->entityManager->persist($comment);
            $this->entityManager->flush();

            return $this->redirectToRoute('comment');
        }

        return $this->render('comment/index.html.twig', [
            'comments'  => $commentRepository->findAll(),
            'form'      => $this->createForm(CommentType::class, new Comment()),
        ]);
    }

    #[Route('/comment/{id}', name: 'comment_show')]
    public function show(Comment $comment): Response
    {
        return $this->render('comment/show.html.twig', [
            'comment' => $comment,
        ]);
    }
}
