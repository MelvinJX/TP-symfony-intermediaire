<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("admin/categories", name="admin_categories_list")
     */
    public function categories(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();
        return $this->render('admin/category/categories.html.twig', ['categories' => $categories]);
    }

    /**
     * @Route("admin/category/{id}", name="admin_category")
     */
    public function category($id, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->find($id);
        return $this->render('admin/category/category.html.twig', ['category' => $category]);
    }

    /**
     * @Route("admin/add/category", name="admin_add_category")
     */
    public function addCategory(Request $request, EntityManagerInterface $entityManagerInterface)
    {
        $category = new Category();
        $categoryForm = $this->createForm(CategoryType::class, $category);
        $categoryForm->handleRequest($request);

        if($categoryForm->isSubmitted() && $categoryForm->isValid()) {

            $entityManagerInterface->persist($category);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('admin_categories_list');
        }

        return $this->render('admin/category/add_category.html.twig', ['categoryForm' => $categoryForm->createView()]);
    }
}