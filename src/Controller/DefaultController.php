<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Models;
use App\Entity\Users;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends AbstractController{


    /**
     * @Route("/", name="home", defaults={"reactRouting": null})
     */
    public function index(): Response
    {
        return $this->render('home.html.twig');
    }

    /**
     * @Route("/api/featured", name="home")
     * @return Response
     */
    public function getFeatured(): Response
    {
        $featured = $this->getDoctrine()->getRepository(Models::class)->findFeatured();

        return $this->json($featured);
    }

    /**
     * @Route("/search", name="search", defaults={"reactRouting": null})
     * @param Request $request
     * @return Response
     */
    public function search(Request $request): Response
    {
        $data=$request->get('search');
        return $this->render('search.html.twig',['data'=>$data,'id'=>1]);
    }

    /**
     * @Route("/api/search/{query}", name="searchget", methods={"GET","HEAD"})
     * @param string $query
     * @return Response
     */
    public function searchModel(string $query): Response
    {

        $repo = $this->getDoctrine()
            ->getRepository(Models::class);
        $data = $repo->createQueryBuilder('m')
            ->where('m.title LIKE :title')
            ->setParameter('title','%'.$query.'%')
            ->getQuery()
            ->getResult();

        return $this->json($data);
    }
    /**
     * @Route("/api/search/", name="searchget", methods={"GET","HEAD"})
     * @return Response
     */
    public function searchEmpty(): Response
    {


        $data = $this->getDoctrine()->getRepository(Models::class)->findAll();

        return $this->json($data);
    }


}