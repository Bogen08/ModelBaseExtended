<?php

namespace App\Controller;

use App\Entity\Models;
use App\Entity\Users;
use App\Form\Type\ModelType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractApiController
{
    /**
     * @Route("/user/{id}", name="user", defaults={"reactRouting": null})
     * @param int $id
     * @return Response
     */
    public function user(int $id): Response
    {
        return $this->render('user.html.twig',['id'=>$id]);
    }

    /**
     * @Route("/api/userget/{id}", name="userget")
     * @param int $id
     * @return Response
     */
    public function getUsers(int $id): Response
    {
        $user = $this->getDoctrine()->getRepository(Users::class)->find($id);

        return $this->json($user);

    }

    /**
     * @Route("/api/userModels/{id}", name="userModels")
     * @param int $id
     * @return Response
     */
    public function getUserModels(int $id): Response
    {
        $models = $this->getDoctrine()->getRepository(Models::class)->findBy(array('owner_id'=>$id));

        return $this->json($models);
    }

}