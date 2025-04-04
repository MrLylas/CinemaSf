<?php

namespace App\Controller;

use Dom\Entity;
use App\Entity\Person;
use App\Entity\Director;
use App\Form\DirectorType;
use App\Repository\DirectorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class DirectorController extends AbstractController
{
    #[Route('/director', name: 'app_director')]
    public function index(DirectorRepository $directorRepository): Response
    {
        $directors = $directorRepository->findAll();

        return $this->render('director/index.html.twig', [
            'controller_name' => 'DirectorController',
            'directors' => $directors
        ]);
    }
    #[Route('/director/new', name: 'new_director')]
    public function new(EntityManagerInterface $entityManager, Request $request): Response
    {
        $person = new Person();
        $director = new Director();
        $form = $this->createForm(DirectorType::class, $director);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $person = $director->getPerson();
            $poster = $form->get('person')->get('poster')->getData();
            if ($poster) {
                $originalFilename = pathinfo($poster->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename . '-' . uniqid() . '.' . $poster->guessExtension();
                $poster->move('images', $newFilename);
                $person->setPoster($newFilename);
            }
            $entityManager->persist($director);
            $entityManager->persist($person);
            $entityManager->flush();
            return $this->redirectToRoute('app_director');
        }
        return $this->render('director/new.html.twig', [
            'meta_description' => 'New director',
            'form' => $form,
        ]);
    }
}
