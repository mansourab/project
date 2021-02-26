<?php

namespace App\Controller;

use App\Entity\MemoireOptions;
use App\Form\MemoireFormType;
use App\Form\MemoireOtionsFormType;
use App\Repository\MemoireOptionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class MemoireOptionsController extends AbstractController
{

    /**
     * @Route("/memoire/options/index", name="memoire_option_index")
     */
    public function index(MemoireOptionsRepository $repo)
    {
        $options = $repo->findAll();
        return $this->render('options/index.html.twig', [
            'options' => $options
        ]);
    }

    /**
     * @Route("/memoire/option/create", name="memoire_option_add")
     */
    public function add(Request $request, EntityManagerInterface $em)
    {
        $option = new MemoireOptions();

        $form = $this->createForm(MemoireOtionsFormType::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($option);
            $em->flush();

            return $this->redirectToRoute('memoire_option_index');
        }

        return $this->render('options/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/memoire/option/edit/{id}", name="memoire_option_edit")
     * @param MemoireOptions $memoire
     * @param EntityManagerInterface $em
     */
    public function edit(MemoireOptions $type, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(MemoireOtionsFormType::class, $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            
            // $this->addFlash('info', 'Item modifié avec succès');
            return $this->redirectToRoute("memoire_option_index");
        }

        return $this->render('options/edit.html.twig', [
            'type' => $type,
            'form' => $form->createView()
        ]);
    }
}