<?php

namespace ArrasFilmFestival\BackOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use \DateTime;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $date = new Datetime('NOW');
        $builder
            ->add('title', null, array('label' => 'Titre'))
            ->add('content', 'ckeditor',  array(
                'label' => 'Contenu',
                'config' => array(
                    'toolbar' => array(
                        array(
                            'name'  => 'document',
                            'items' => array('Source', '-', 'Save', 'NewPage', 'DocProps', 'Preview', '-', 'Templates'),
                        ),
                        array(
                            'name'  => 'basicstyles',
                            'items' => array('Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'),
                        ),
                    ),
                    'uiColor' => '#000000',
                ),
            ))
            ->add('created', 'hidden',  array('data' => $date->format('d/m/Y h:i')))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArrasFilmFestival\BackOfficeBundle\Entity\Article'
        ));
    }

    public function getName()
    {
        return 'arrasfilmfestival_backofficebundle_articletype';
    }
}
