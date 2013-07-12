<?php

namespace ArrasFilmFestival\FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ArrasFilmFestival\BackOfficeBundle\Entity\Article;

class PageController extends Controller
{
    public function homeAction()
    {
    	$em = $this->getDoctrine()->getManager();

        $query = $em->createQuery('SELECT e FROM BackOfficeBundle:Article e ORDER BY e.created DESC');
        $query->setMaxResults(5);
        $articles = $query->getResult();

        $query = $em->createQuery('SELECT e FROM BackOfficeBundle:Event e WHERE e.startDate > CURRENT_TIMESTAMP() ORDER BY e.startDate ASC');
        $query->setMaxResults(1);
        $event = $query->getResult();
        return $this->render('FrontOfficeBundle:Page:home.html.twig', array(
        	'articles' 	=> $articles,
        	'event'		=> ($event != null) ? $event[0] : $event,
        ));
    }

    public function articleAction()
    {
		$em    = $this->getDoctrine()->getManager();
		$dql   = "SELECT a FROM BackOfficeBundle:Article a ORDER BY a.created DESC";
		$query = $em->createQuery($dql);

		$paginator  = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
			$query,
			$this->get('request')->query->get('page', 1),
			5
		);

		return $this->render('FrontOfficeBundle:Page:article.html.twig', array('pagination' => $pagination));
    }

    public function showAction($slug)
    {
		$em    = $this->getDoctrine()->getManager();
		$dql   = $em->createQuery("SELECT a FROM BackOfficeBundle:Article a WHERE a.slug = :slug")->setParameter('slug', $slug);
		$article = $dql->getResult();
		
		return $this->render('FrontOfficeBundle:Page:showarticle.html.twig', array('article' => $article[0]));
    }

    public function photoAction()
    {
		$em    = $this->getDoctrine()->getManager();
		$dql   = "SELECT a FROM BackOfficeBundle:Photo a ORDER BY a.created DESC";
		$query = $em->createQuery($dql);

		$paginator  = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
			$query,
			$this->get('request')->query->get('page', 1),
			9
		);

		return $this->render('FrontOfficeBundle:Page:photo.html.twig', array('pagination' => $pagination));
    }

    public function videoAction()
    {
		$em    = $this->getDoctrine()->getManager();
		$dql   = "SELECT a FROM BackOfficeBundle:Video a ORDER BY a.created DESC";
		$query = $em->createQuery($dql);

		$paginator  = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
			$query,
			$this->get('request')->query->get('page', 1),
			5
		);

		return $this->render('FrontOfficeBundle:Page:video.html.twig', array('pagination' => $pagination));
    }

    public function podcastAction()
    {
		$em    = $this->getDoctrine()->getManager();
		$dql   = "SELECT a FROM BackOfficeBundle:Podcast a ORDER BY a.created DESC";
		$query = $em->createQuery($dql);

		$paginator  = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
			$query,
			$this->get('request')->query->get('page', 1),
			9
		);

		return $this->render('FrontOfficeBundle:Page:podcast.html.twig', array('pagination' => $pagination));
    }

    public function programmeAction()
    {
		$em  = $this->getDoctrine()->getManager();
		$events = $em->getRepository('BackOfficeBundle:Event')->findAll();

		return $this->render('FrontOfficeBundle:Page:programme.html.twig', array('events' => $events));
    }
}
