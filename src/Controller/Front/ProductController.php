<?php

namespace App\Controller\Front;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("products", name="products_list")
     */
    public function products(ProductRepository $productRepository)
    {
        $products = $productRepository->findAll();
        return $this->render('front/product/products.html.twig', ['products' => $products]);
    }

    /**
     * @Route("product/{id}", name="product")
     */
    public function product($id, ProductRepository $productRepository)
    {
        $product = $productRepository->find($id);
        return $this->render('front/product/product.html.twig', ['product' => $product]);
    }
}