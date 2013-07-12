<?php

namespace ArrasFilmFestival\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
    public function homeAction()
    {
    	$em = $this->getDoctrine()->getManager();
        $deleteForm = null;
        $users 	= $em->getRepository('BackOfficeBundle:User')->findAll();
		$array = array();

        foreach ($users as $key => $user) {
        	$array[$key]['user'] = $user;
        	$array[$key]['value'] = 0;

        	$query = $em->createQuery('SELECT p FROM BackOfficeBundle:Article p WHERE p.user = :id')->setParameter('id', $user->getId());
        	$tmp = $query->getResult();
        	$array[$key]['value'] += count($tmp);
        	$query = $em->createQuery('SELECT p FROM BackOfficeBundle:Photo p WHERE p.user = :id')->setParameter('id', $user->getId());
        	$tmp = $query->getResult();
        	$array[$key]['value'] += count($tmp);
        	$query = $em->createQuery('SELECT p FROM BackOfficeBundle:Video p WHERE p.user = :id')->setParameter('id', $user->getId());
        	$tmp = $query->getResult();
        	$array[$key]['value'] += count($tmp);
        	$query = $em->createQuery('SELECT p FROM BackOfficeBundle:Podcast p WHERE p.user = :id')->setParameter('id', $user->getId());
        	$tmp = $query->getResult();
        	$array[$key]['value'] += count($tmp);
        }

        foreach ($array as $key => $row) {
		    $point[$key]  = $row['value'];
		}

        array_multisort($point, SORT_DESC, $array);

	    $array = array_chunk($array, 10);

    	return $this->render('BackOfficeBundle:Page:statistic.html.twig', array(
    		'array' => $array[0]
        ));
    }

    public function informationAction()
    {
    	return $this->render('BackOfficeBundle:Page:information.html.twig');
    }
}
