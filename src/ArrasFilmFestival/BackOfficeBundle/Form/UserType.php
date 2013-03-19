<?php

namespace ArrasFilmFestival\BackOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login')
            ->add('password')
            ->add('name')
            ->add('surname')
            ->add('team')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArrasFilmFestival\BackOfficeBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'arrasfilmfestival_backofficebundle_usertype';
    }
}
