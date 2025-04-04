<?php

namespace App\Controller;

use Dom\Entity;
use App\Entity\Person;
use App\Entity\Comedian;
use App\Form\ComedianType;
use App\Repository\ComedianRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ComedianController extends AbstractController
{
    #[Route('/comedian', name: 'app_comedian')]
    public function index(ComedianRepository $comedianRepository): Response
    {
        $comedians = $comedianRepository->findAll();

        return $this->render('comedian/index.html.twig', [
            'controller_name' => 'ComedianController',
            'comedians' => $comedians
        ]);
    }
    #[Route('/comedian/new', name: 'new_comedian')]
    public function new(EntityManagerInterface $entityManager, Request $request): Response
    {
        $person = new Person();
        $comedian = new Comedian();
        $form = $this->createForm(ComedianType::class, $comedian);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $person = $comedian->getPerson();
            $poster = $form->get('person')->get('poster')->getData();
            if ($poster) {
                $originalFilename = pathinfo($poster->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename . '-' . uniqid() . '.' . $poster->guessExtension();
                $poster->move('images', $newFilename);
                $person->setPoster($newFilename);
            }
            $entityManager->persist($comedian);
            $entityManager->persist($person);
            $entityManager->flush();
            return $this->redirectToRoute('app_comedian');
        }
        return $this->render('comedian/new.html.twig', [
            'meta_description' => 'New comedian',
            'form' => $form,
        ]);
    }
}
