<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchForm;
use App\Repository\MemoireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_home")
     */
    public function index(MemoireRepository $repo): Response
    {
        

        $latestMemoires = $repo->findLatest();

        return $this->render('layouts/home.html.twig', [
            'latests' => $latestMemoires,
        ]);
    }
}
