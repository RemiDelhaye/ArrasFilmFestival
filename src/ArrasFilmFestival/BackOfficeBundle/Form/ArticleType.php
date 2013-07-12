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
                            'items' => array('Source', '-', 'NewPage', 'DocProps', 'Preview', '-', 'Maximize'),
                        ),
                        array(
                            'name'  => 'basicstyles',
                            'items' => array('Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'),
                        ),
                        array(
                            'name'  => 'inserts',
                            'items' => array('Image'),
                        ),
                    ),
                    'uiColor' => '#000000',
                    'filebrowserBrowseRoute' => 'elfinder',
                ),
            ))
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
