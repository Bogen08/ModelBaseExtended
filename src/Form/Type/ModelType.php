<?php


namespace App\Form\Type;


use App\Entity\Models;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;

class ModelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('owner_id', IntegerType::class,[
                'constraints' => [
                    new NotNull(),
                ]
            ])
            ->add('title', TextType::class,[
                'constraints' => [
                    new NotNull(),
                    new Length([
                        'min' => 1,
                    ])
                ]
            ])
            ->add('img1', TextType::class)
            ->add('img2', TextType::class)
            ->add('model', TextType::class,[
                'constraints' => [
                    new NotNull(),
                ]
            ])
            ->add('rafts', TextType::class,[
                'constraints' => [
                    new NotNull(),
                ]
            ])
            ->add('supports', TextType::class,[
                'constraints' => [
                    new NotNull(),
                ]
            ])
            ->add('resolution', TextType::class,[
                'constraints' => [
                    new NotNull(),
                ]
            ])
            ->add('infill', TextType::class,[
                'constraints' => [
                    new NotNull(),
                ]
            ])
            ->add('category_id', IntegerType::class,[
                'constraints' => [
                    new NotNull(),
                ]
            ])
            ->add('description', TextType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Models::class,
        ]);
    }

}