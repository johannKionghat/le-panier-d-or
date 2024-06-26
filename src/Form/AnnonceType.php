<?php

namespace App\Form;

use App\Entity\Listings;
use App\Entity\User;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
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
            ->add('description',TextareaType::class, [
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>false,
            ])
            ->add('shortDescription',TextareaType::class, [
                'required'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>false,
            ])
            ->add('price',IntegerType::class, [
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
            ->addEventListener(FormEvents::POST_SUBMIT, $this->autoSetAT(...))
        ;
    }
    public function autoSetAT(PostSubmitEvent $event): void{
        $data=$event->getData();
        if(!($data instanceof Listings)){
            return;
        }
        if(!($data->getId())){
            $data->setCreatedAt(new DateTime);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Listings::class,
        ]);
    }
}
