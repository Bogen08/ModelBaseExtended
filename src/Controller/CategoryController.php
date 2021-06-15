<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Models;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class CategoryController extends AbstractController{


    /**
     * @Route("/category/{id}", name="home", defaults={"reactRouting": null})
     * @param int $id
     * @return Response
     */
    public function category(int $id): Response
    {
        return $this->render('category.html.twig',['id'=>$id]);
    }

    /**
     * @Route("/api/categorylist", name="home")
     * @return Response
     */
    public function getCategoryList(): Response
    {
        $categories = $this->getDoctrine()->getRepository(Categories::class)->findAll();

        return $this->json($categories);

    }

    /**
     * @Route("/api/categoryget/{id}", name="home")
     * @param int $id
     * @return Response
     */
    public function getCategory(int $id): Response
    {
        $category = $this->getDoctrine()->getRepository(Categories::class)->find($id);

        return $this->json($category);

    }

    /**
     * @Route("/api/category/{id}", name="home")
     * @param int $id
     * @return Response
     */
    public function getCategoryContents(int $id): Response
    {
        $categories = $this->getDoctrine()->getRepository(Models::class)->findBy(array('category_id'=>$id));

        return $this->json($categories);

    }


}