<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Departement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AjouterArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image',FileType::class)
            ->add('titre',TextType::class)
            ->add('pieces',NumberType::class)
            ->add('terasse',ChoiceType::class, [
                'choices'  => [
                    
                    'Oui' => 'Oui',
                    'Non' => 'Non',
                              ],
                ])
            ->add('parking',ChoiceType::class,[
                'choices'  => [
                  
                    'Oui' => 'Oui',
                    'Non' => 'Non',
                              ],
                ])
            ->add('localisation',TextType::class)
            ->add('loyer',NumberType::class)
            ->add('meuble',ChoiceType::class,[
                'choices'  => [
                  
                    'Oui' => 'Oui',
                    'Non' => 'Non',
                              ],
                ])
            ->add('transaction',ChoiceType::class,[
                    'choices'  => [
                    'Location' => 'Location',
                    'Vente' => 'Vente',
                              ],
                ])
            ->add('photo1',FileType::class)
            ->add('photo2',FileType::class)
            ->add('photo3',FileType::class)
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'mapped'=>true
            ])
            ->add('departement', EntityType::class, [
                'class' => Departement::class,
                'mapped'=>false
            ]);
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
