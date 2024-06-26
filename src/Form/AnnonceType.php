<?php

namespace App\Form;

use App\Entity\Listings;
use App\Entity\User;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class, [
                'label'=>false,
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('description',TextType::class, [
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>false,
            ])
            ->add('price',NumberType::class, [
                'label'=>false,
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('category',TextType::class, [
                'label'=>false,
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('thumbnailFile', FileType::class,[
                'required'=>false,
                'label'=>false,
                'mapped'=>false,
                'constraints'=>[
                    new Image(),
                ],
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('save', SubmitType::class,[
                'label'=>'Envoyer',
                'attr'=>[
                    'class'=>'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Listings::class,
        ]);
    }
}
