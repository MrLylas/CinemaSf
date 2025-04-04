<?php

namespace App\Controller;

use App\Entity\Casting;
use App\Form\CastingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\HttpCache\Esi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CastingController extends AbstractController
{
    #[Route('/casting', name: 'app_casting')]
    public function index(): Response
    {
        return $this->render('casting/index.html.twig', [
            'controller_name' => 'CastingController',
        ]);
    }
    #[Route('/casting/new', name: 'new_casting')]
    public function new(EntityManagerInterface $entityManager, Request $request): Response
    {
        $casting = new Casting();
        $form = $this->createForm(CastingType::class, $casting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($casting);
            $entityManager->flush();
            return $this->redirectToRoute('app_casting');
        }
        return $this->render('casting/new.html.twig', [
            'controller_name' => 'CastingController',
            'form' => $form
        ]);
    }
}
