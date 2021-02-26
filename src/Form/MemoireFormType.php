<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Memoire;
use App\Entity\MemoireOptions;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;


class MemoireFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('author')
            ->add('domaine')
            ->add('specialite')
            ->add('attachment', VichFileType::class)
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('format', ChoiceType::class, [
                'choices' => [
                    'PDF' => 'PDF',
                    'DOC' => 'DOC',
                    'IMG' => 'IMG'
                ]
            ])
            ->add('type', EntityType::class, [
                'class' => MemoireOptions::class,
                'expanded' => true
            ])
            ->add('publier')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Memoire::class,
        ]);
    }
}
