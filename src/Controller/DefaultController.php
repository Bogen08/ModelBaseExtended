<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends AbstractController{


    public function index(): Response
    {
        return $this->render('home.html.twig');
    }

    public function model(): Response
    {
        return $this->render('model.html.twig');
    }
}