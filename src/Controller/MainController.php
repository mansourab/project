<?php

namespace App\Controller;


use App\Repository\MemoireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(MemoireRepository $repo): Response
    {
        $latestMemoires = $repo->findLatest();

        return $this->render('layouts/main.html.twig', [
            'latests' => $latestMemoires,
        ]);
    }
}
