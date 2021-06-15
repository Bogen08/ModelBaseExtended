<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


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
    public function getFeatured()
    {
        $featured = [
            [
                'id' => 1,
                'owner' => 'Mister A',
                'title' => 'Ghost keychain',
                'img1' => 'img/placeholders/1.jpg'
            ],
            [
                'id' => 2,
                'owner' => 'Mister A',
                'title' => 'Ghost keychain',
                'img1' => 'img/placeholders/2.jpg'
            ],
            [
                'id' => 3,
                'owner' => 'Mister A',
                'title' => 'Ghost keychain',
                'img1' => 'img/placeholders/3.jpg'
            ],
        ];

        $response = new Response();

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $response->setContent(json_encode($featured));

        return $response;
    }


}