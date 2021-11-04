<?php

namespace App\Controller\Front;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("categories", name="categories_list")
     */
    public function categories(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();
        return $this->render('front/category/categories.html.twig', ['categories' => $categories]);
    }

    /**
     * @Route("category/{id}", name="category")
     */
    public function category($id, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->find($id);
        return $this->render('front/category/category.html.twig', ['category' => $category]);
    }
}