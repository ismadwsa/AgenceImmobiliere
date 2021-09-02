<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Departement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdatArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('image',FileType::class,['multiple'=> true])
            ->add('titre')
            ->add('pieces')
            ->add('terasse')
            ->add('parking')
            ->add('localisation')
            ->add('loyer')
            ->add('meuble')
            ->add('transaction')
            ->add('photo1')
            ->add('photo2')
            ->add('photo3')
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'mapped'=>true
            ])
            ->add('departement', EntityType::class, [
                'class' => Departement::class,
                'mapped'=>false
            ])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
