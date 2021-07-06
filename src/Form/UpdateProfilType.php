<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class UpdateProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom')
            ->add('Prenom')
            ->add('Age')
            ->add('Telephone')
            ->add('Adresse')
            // ->add('ImageFile', VichFileType::class, [
            //     'required' => false,
            //     'allow_delete' => true,
            //     'delete_label' => 'Remove Photo',
            //     'download_uri' => true,
            //     'download_label' => 'Download Photo',
            //     'asset_helper' => true,
            //     'data_class' => null,
            //     'empty_data' => '',
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
