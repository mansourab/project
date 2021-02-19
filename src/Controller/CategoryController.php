<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryFormType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{


    
    /**
     * @Route("/memoire/category/index", name="category_index")
     * @return \Symfony\Component\HttpFoundation\Response 
     */
    public function list(CategoryRepository $repo): Response
    {
        $categories = $repo->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/memoire/category/create", name="category_add")
     */
    public function add(Request $request, EntityManagerInterface $em)
    {
        $category = new Category();

        $form = $this->createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute("category_index");
        }

        return $this->render('category/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/memoire/category/edit/{id}", name="category_edit")
     * @param Category $category
     * @param EntityManagerInterface $em
     */
    public function edit(Category $category, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            
            // $this->addFlash('info', 'Item modifié avec succès');
            return $this->redirectToRoute("category_index");
        }

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/memoire/category/delete{id}", name="category_delete", methods="DELETE")
     * @param Category $category
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Category $category, EntityManagerInterface $em, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' .$category->getId(), $request->get('_token'))) {
            $em->remove($category);
            $em->flush();
            // $this->addFlash('info', 'Item supprimé avec succès');
        }
        return $this->redirectToRoute('category_index');
    }

}