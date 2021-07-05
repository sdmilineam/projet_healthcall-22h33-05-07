<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\ImageProfil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class CreatPostRDVType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom')
            ->add('Prenom')
            ->add('telephone')
            ->add('adress')
            ->add('Pro')
            ->add('image', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Remove Photo',
                'download_uri' => true,
                'download_label' => 'Download Photo',
                'asset_helper' => true,
            ])
            // je ajouté le champ 'image' dans formulaire
            //Il n'est pas conneté avec BBD

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
