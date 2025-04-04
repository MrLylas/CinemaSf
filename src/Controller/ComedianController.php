<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ComedianController extends AbstractController
{
    #[Route('/comedian', name: 'app_comedian')]
    public function index(): Response
    {
        return $this->render('comedian/index.html.twig', [
            'controller_name' => 'ComedianController',
        ]);
    }
}
