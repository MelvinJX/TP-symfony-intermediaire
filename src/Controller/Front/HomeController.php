<?php

namespace App\Controller\Front;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("search", name="search_product")
     */
    public function search(ProductRepository $productRepository, Request $request)
    {
        $motCle = $request->query->get('search');
        $products = $productRepository->searchMotCle($motCle);

        return $this->render('front/search.html.twig', ['products' => $products, 'motCle' => $motCle]);
    }
}