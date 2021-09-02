<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class UpdateUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,[
                'label'=>'Nom',
                 'attr'=>[
                     'placeholder'=>'Votre nom'
                     ]
                  ])
            ->add('prenom',TextType::class,[
                'label'=>'Prénom',
                 'attr'=>[
                     'placeholder'=>'Votre prénom'
                     ]
                  ])
            ->add('email',EmailType::class,[
                'label'=>'Email',
                 'attr'=>[
                     'placeholder'=>'Votre adresse mail'
                     ]
                  ])
            ->add('password',PasswordType::class,[
                'label'=>'Mot de Passe',
                 'attr'=>[
                     'placeholder'=>'Insérez votre mot de passe'
                     ]
                  ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
