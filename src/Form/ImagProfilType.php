<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ImagProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Username')
            ->add('roles')
            ->add('password')
            ->add('Nom')
            ->add('Prenom')
            ->add('Age')
            ->add('Email')
            // ->add('imageFile', VichImageType::class, [
            //     'required' => false,
            //     'allow_delete' => true,
            //     'delete_label' => 'Remove the image',
            //     'download_label' => 'Download an image',
            //     'download_uri' => true,
            //     'image_uri' => true,
            //     'asset_helper' => true,
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
