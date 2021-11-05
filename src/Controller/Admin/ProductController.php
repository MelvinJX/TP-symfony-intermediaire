<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("admin/add/product", name="admin_add_product")
     */
    public function addProduct(Request $request, EntityManagerInterface $entityManagerInterface)
    {
        $product = new Product();
        $productForm = $this->createForm(ProductType::class, $product);
        $productForm->handleRequest($request);

        if($productForm->isSubmitted() && $productForm->isValid()) {

            $entityManagerInterface->persist($product);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('admin_products_list');
        }

        return $this->render('admin/product/add_product.html.twig', ['productForm' => $productForm->createView()]);
    }

    /**
     * @Route("admin/update/product/{id}", name="admin_update_product")
     */
    public function updateProduct($id, ProductRepository $productRepository, EntityManagerInterface $entityManagerInterface, Request $request)
    {
        $product = $productRepository->find($id);
        $productForm = $this->createForm(ProductType::class, $product);
        $productForm->handleRequest($request);

        if($productForm->isSubmitted() && $productForm->isValid()) {

            $entityManagerInterface->persist($product);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('admin_products_list');
        }

        return $this->render('admin/product/update_product.html.twig', ['productForm' => $productForm->createView()]);
    }

    /**
     * @Route("admin/delete/product/{id}", name="admin_delete_product")
     */
    public function deleteProduct($id, ProductRepository $productRepository, EntityManagerInterface $entityManagerInterface)
    {
        $product = $productRepository->find($id);

        $entityManagerInterface->remove($product);
        $entityManagerInterface->flush();

        return $this->redirectToRoute('admin_products_list');
    }
}