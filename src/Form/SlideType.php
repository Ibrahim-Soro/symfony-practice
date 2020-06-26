<?php

namespace App\Form;

use App\Entity\Slide;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SlideType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFileUn', FileType::class, [
                'label' => 'image introductive 1',
                'required' => false
            ])
            ->add('imageFileDeux', FileType::class, [
                'label' => 'image introductive 2',
                'required' => false
            ])
            ->add('imageFileTrois', FileType::class, [
                'label' => 'image introductive 3',
                'required' => false
            ])
            ->add('alt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Slide::class,
        ]);
    }
}
