<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Memoire;
use App\Form\MemoireFormType;
use App\Form\SearchForm;
use App\Repository\MemoireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MemoireController extends AbstractController
{

    /**
     * @Route("/memoire/index", name="memoire_index")
     * @return \Symfony\Component\HttpFoundation\Response 
     */
    public function list(MemoireRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {
        // $memoires = $repo->findAll();

        // return $this->render('memoire/index.html.twig', [
        //     'memoires' => $memoires
        // ]);

        $data = new SearchData();

        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);

        // $memoires = $repo->findSearch($data);

        $memoires = $paginator->paginate(
            $repo->findSearch($data), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );

        return $this->render('memoire/index.html.twig', [
            'form' => $form->createView(),
            'memoires' => $memoires,
        ]);

    }

    /**
     * @Route("/memoire/create", name="memoire_add")
     */
    public function add(Request $request, EntityManagerInterface $em)
    {
        $memoire = new Memoire();

        $form = $this->createForm(MemoireFormType::class, $memoire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($memoire);
            $em->flush();

            return $this->redirectToRoute("memoire_index");
        }

        return $this->render('memoire/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/memoire/edit/{id}", name="memoire_edit")
     * @param Memoire $memoire
     * @param EntityManagerInterface $em
     */
    public function edit(Memoire $memoire, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(MemoireFormType::class, $memoire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            
            // $this->addFlash('info', 'Item modifié avec succès');
            return $this->redirectToRoute("memoire_index");
        }

        return $this->render('memoire/edit.html.twig', [
            'memoire' => $memoire,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/memoire/show/{id}", name="memoire_show")
     */
    public function show(Memoire $memoire)
    {
        if (!$memoire) {
            throw $this->createNotFoundException('Memoire not found'); 
        }

        return $this->render('memoire/show.html.twig', [
            'memoire' => $memoire
        ]);
    }

    /**
     * @Route("/memoire/delete{id}", name="memoire_delete", methods="DELETE")
     * @param Memoire $memoire
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteItem(Memoire $memoire, EntityManagerInterface $em, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' .$memoire->getId(), $request->get('_token'))) {
            $em->remove($memoire);
            $em->flush();
            // $this->addFlash('info', 'Item supprimé avec succès');
        }
        return $this->redirectToRoute('memoire_index');
    }
}