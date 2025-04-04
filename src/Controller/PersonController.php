<?php

namespace App\Controller;

use App\Entity\Director;
use App\Entity\Person;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PersonController extends AbstractController
{
    #[Route('/person', name: 'app_person')]
    public function index(): Response
    {
        return $this->render('person/index.html.twig', [
            'controller_name' => 'PersonController',
        ]);
    }
    #[Route('/person/show/{id}', name: 'app_person_show')]
    public function show(Person $person): Response
    {
        return $this->render('person/show.html.twig', [
            'controller_name' => 'DirectorController',
            'person' => $person
        ]);
    }
}
