<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface as FormFormBuilderInterface;
use Symfony\Component\Form\Test\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
class SearchForm extends AbstractType
{
    public function buildForm(FormFormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('q',TextType::class,[
           'label'=>false,
            'attr'=>[
                'placeholder'=>'Réference du bien'
                ]
             ]);
        

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection'=>false,
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }
}