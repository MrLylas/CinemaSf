<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class MovieController extends AbstractController
{
    #[Route('/movie', name: 'app_movie')]
    public function index(MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findAll();
        return $this->render('movie/index.html.twig', [
            'meta_description' => 'Movies list',
            'movies' => $movies
        ]);
    }

    #[Route('/movie/new', name: 'app_movie_new')]
    public function new(EntityManagerInterface $entityManager, Request $request): Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $poster = $form->get('poster')->getData();
            if ($poster) {
                $originalFilename = pathinfo($poster->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename . '-' . uniqid() . '.' . $poster->guessExtension();
                $poster->move('images', $newFilename);
                $movie->setPoster($newFilename);
            }
            $entityManager->persist($movie);
            $entityManager->flush();

            return $this->redirectToRoute('app_movie');
        }

        return $this->render('movie/new.html.twig', [
            'meta_description' => 'New movie',
            'form' => $form
        ]);
    }

    #[Route('/movie/{id}', name: 'app_movie_show')]
    public function show(Movie $movie): Response
    {
        return $this->render('movie/show.html.twig', [
            'meta_description' => $movie->getName(),
            'movie' => $movie
        ]);
    }
}
