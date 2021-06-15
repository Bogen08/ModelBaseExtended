<?php

namespace App\Controller;

use Symfony\Component\Form\FormInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



abstract class AbstractApiController extends AbstractController
{

    protected function buildForm(string $type, $data = null, array $options = []): FormInterface
    {
        $options = array_merge($options,[
            'csrf_protection' => false,
        ]);

       return $this->container->get('form.factory')->createNamed('', $type, $data, $options);
    }


}