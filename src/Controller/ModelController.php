<?php

namespace App\Controller;

use App\Entity\Models;
use App\Form\Type\ModelType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModelController extends AbstractApiController
{
    /**
     * @Route("/model/{reactRouting}", name="model", defaults={"reactRouting": 1})
     */
    public function model(): Response
    {
        return $this->render('model.html.twig');
    }

    /**
     * @Route("/api/model", name="modelview")
     * @return Response
     */
    public function getModel()
    {
        $model = [
            'id' => 1,
            'owner' => 'Goben',
            'title' => 'Ghost Keychain',
            'img1' => '2.jpg',
            'img2' => '3.png',
            'model' => 'keychain3.stl',
            'rafts' => 'yes',
            'supports' => 'yes',
            'resolution' => 1280,
            'infill' => 0.7,
            'category_id' => 1,
            'description' => 'Lorem ipsum'
        ];

        $response = new Response();

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $response->setContent(json_encode($model));

        return $response;
    }
    /**
     * @Route("/api/v1/models", name="models_list")
     * @return Response
     */
    public function indexAction(Request $request) : Response
    {
        $models = $this->getDoctrine()->getRepository(Models::class)->findAll();

        return $this->json($models);
    }

    public function createAction(Request $request): Response
    {
        $form = $this->buildForm(ModelType::class);

        $form->handleRequest($request);

        if(!$form->isSubmitted() || !$form->isValid()){
            //throw error
            print 'Error';
            exit;
        }

        /** @var Models $model */
        $model = $form->getData();

        $this->getDoctrine()->getManager()->persist($model);
        $this->getDoctrine()->getManager()->flush();

        return $this->json($model);
    }
}