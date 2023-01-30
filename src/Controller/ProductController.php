<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Product;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
    //creation de la var de co a la bdd.
    private $entityManager;

    //On inject la dependance EntityManagerInterface qu'on stock dans la variable $entityManager dans un __construct.
    public function __construct(EntityManagerInterface $entityManager){
        //
        $this->entityManager = $entityManager;
    }

    #[Route('/nos-produits', name: 'products')]
    public function index(Request $request): Response
    {
        $products = $this->entityManager->getRepository(Product::class)->findAll();
        
        /**
         * Permet de rendre le formulaire sur la page appelée dans le render.
         */
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        /**
         * permet d 'ecouter la request
         */
        $form->handleRequest($request);
        $search = $form->getData();
        dd($search);
        

        /**
         * Le render envvoie la vie 
         * recupére les données de products
         * et créé le formulaire.
         */

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'form' => $form->createView()
        ]);
    }
    #[Route('/produit/{slug}', name: 'product')]
    public function show($slug): Response
    {

        $product = $this->entityManager->getRepository(Product::class)->findOneBySlug($slug);

        if(!$product){
            return $this->redirectToRoute('products');
        }
        return $this->render('product/show.index.html.twig', [

            'product' => $product
        ]);
    }
}