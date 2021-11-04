<?php

namespace App\Controller\Admin;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("admin/products", name="admin_products_list")
     */
    public function products(ProductRepository $productRepository)
    {
        $products = $productRepository->findAll();
        return $this->render('admin/product/products.html.twig', ['products' => $products]);
    }

    /**
     * @Route("admin/product/{id}", name="admin_product")
     */
    public function product($id, ProductRepository $productRepository)
    {
        $product = $productRepository->find($id);
        return $this->render('admin/product/product.html.twig', ['product' => $product]);
    }
}