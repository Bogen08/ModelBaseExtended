<?php


namespace App\Form\Type;


use App\Entity\Models;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;

class ModelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('owner_id',IntegerType::class)
            ->add('title', TextType::class)
            ->add('img1',FileType::class,['mapped' => false])
            ->add('img2',FileType::class,['mapped' => false])
            ->add('model',FileType::class,['mapped' => false])
            ->add('rafts',TextType::class)
            ->add('supports',TextType::class)
            ->add('resolution',TextType::class)
            ->add('infill',TextType::class)
            ->add('category_id',IntegerType::class)
            ->add('description',TextType::class)
            ->add('save',SubmitType::class)
            ;

        /*
        $builder
            ->add('owner_id',IntegerType::class)
            ->add('title', TextType::class)
            ->add('img1',TextType::class)
            ->add('img2',TextType::class)
            ->add('model',TextType::class)
            ->add('rafts',TextType::class)
            ->add('supports',TextType::class)
            ->add('resolution',TextType::class)
            ->add('infill',TextType::class)
            ->add('category_id',IntegerType::class)
            ->add('description',TextType::class)
            ->add('save',SubmitType::class)
        ;
        */
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Models::class,
        ]);
    }

}