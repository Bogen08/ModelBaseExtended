<?php

namespace App\Controller;

use App\Entity\Models;
use App\Entity\Users;
use App\Entity\Categories;
use App\Form\Type\ModelType;
use Doctrine\DBAL\Types\TextType;
use phpDocumentor\Reflection\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class ModelController extends AbstractApiController
{
    /**
     * @Route("/model/{id}", name="model", defaults={"id": 7})
     * @param int $id
     * @return Response
     */
    public function model(int $id): Response
    {
        return $this->render('model.html.twig',['post_id'=>$id]);
    }

    /**
     * @Route("/api/model/{id}", name="modelview", methods={"GET","HEAD"})
     * @param int $id
     * @return Response
     */
    public function getModel(int $id): Response
    {

        $model = $this->getDoctrine()->getRepository(Models::class)->find($id)->orderBy();

        return $this->json($model);
    }

    /**
     * @Route("/add", name="add")
     * @param Request $request
     * @param SluggerInterface $slugger
     * @return Response
     */
    public function addModel(Request $request, SluggerInterface $slugger): Response
    {
        $model = new Models();

        $form = $this->createForm(ModelType::class,$model);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $img1 = $form->get('img1')->getData();
            $img2 = $form->get('img2')->getData();
            $modelf = $form->get('model')->getData();

            $img1filenameorg= pathinfo($img1->getClientOriginalName(), PATHINFO_FILENAME);
            $img2filenameorg= pathinfo($img2->getClientOriginalName(), PATHINFO_FILENAME);
            $modelfilenameorg= pathinfo($modelf->getClientOriginalName(), PATHINFO_FILENAME);

            $img1save=$slugger->slug($img1filenameorg);
            $img2save=$slugger->slug($img2filenameorg);
            $modelsave=$slugger->slug($modelfilenameorg);

            $img1new=$img1save.$img1->guessExtension();
            $img2new=$img2save.$img2->guessExtension();
            $modelnew=$modelsave.$modelf->guessExtension();

            try{
                $img1->move(
                    'uploads/'.$form->get('owner_id')->getData().'/'.$form->get('title')->getData().'/img/',
                    $img1new
                );
            }catch (FileException $e){}
            try{
                $img2->move(
                    'uploads/'.$form->get('owner_id')->getData().'/'.$form->get('title')->getData().'/img/',
                    $img2new
                );
            }catch (FileException $e){}
            try{
                $modelf->move(
                    'uploads/'.$form->get('owner_id')->getData().'/'.$form->get('title')->getData().'/stl/',
                    $modelnew
                );
            }catch (FileException $e){}

            $model->setOwnerId($form->get('owner_id')->getData());
            $model->setTitle($form->get('title')->getData());
            $model->setImg1($img1new);
            $model->setImg2($img2new);
            $model->setModel($modelnew);
            $model->setRafts($form->get('rafts')->getData());
            $model->setSupports($form->get('supports')->getData());
            $model->setResolution($form->get('resolution')->getData());
            $model->setInfill($form->get('infill')->getData());

            $em = $this->getDoctrine()->getManager();
            $em->persist($model);
            $em->flush();

            return $this->redirectToRoute("index");
        }

        return $this->render('add.html.twig',[
        'form' => $form->createView(),
        ]);
    }



}