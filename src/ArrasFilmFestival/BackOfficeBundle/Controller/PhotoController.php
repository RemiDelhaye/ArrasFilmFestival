<?php

namespace ArrasFilmFestival\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ArrasFilmFestival\BackOfficeBundle\Entity\Content;
use ArrasFilmFestival\BackOfficeBundle\Form\Type\ContentType;

use Symfony\Component\HttpFoundation\Request;

class PhotoController extends Controller
{
    public function newAction()
    {
    	$content = new Content();
    	$form = $this->createForm(new ContentType(), $conten);
    }

    public function createAction()
    {
    	$content = new Content();
    	$form = $this->createForm(new ContentType(), $content);
    }
}
