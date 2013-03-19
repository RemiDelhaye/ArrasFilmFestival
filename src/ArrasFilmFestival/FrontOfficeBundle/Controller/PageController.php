<?php

namespace ArrasFilmFestival\FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function homeAction()
    {
        return $this->render('FrontOfficeBundle:Page:home.html.twig');
    }
}
