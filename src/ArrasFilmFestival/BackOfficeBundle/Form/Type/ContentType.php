<?php
namespace ArrasFilmFestival\BackOfficeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')
        		->add('content');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
	    $resolver->setDefaults(array(
	        'data_class' => 'ArrasFilmFestival\BackOfficeBundle\Entity\Content',
	    ));
	}

    public function getName()
    {
        return 'content';
    }
}