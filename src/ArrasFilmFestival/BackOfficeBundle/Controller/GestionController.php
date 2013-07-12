<?php

namespace ArrasFilmFestival\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

class GestionController extends Controller
{
    public function validateindexAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$deleteForm = null;
       	$articles 	= $em->getRepository('BackOfficeBundle:Article')->findByValidate(0);
       	$photos 	= $em->getRepository('BackOfficeBundle:Photo')->findByValidate(0);
       	$podcasts 	= $em->getRepository('BackOfficeBundle:Podcast')->findByValidate(0);
       	$videos 	= $em->getRepository('BackOfficeBundle:Video')->findByValidate(0);

       	foreach($articles as $entity){
            $deleteForm[] = $this->createDeleteForm($entity->getId())->createView();
        }

        foreach($photos as $entity){
            $deleteForm[] = $this->createDeleteForm($entity->getId())->createView();
        }

        foreach($podcasts as $entity){
            $deleteForm[] = $this->createDeleteForm($entity->getId())->createView();
        }

        foreach($videos as $entity){
            $deleteForm[] = $this->createDeleteForm($entity->getId())->createView();
        }

       	return $this->render('BackOfficeBundle:Gestion:validateindex.html.twig', array(
            'articles'      => $articles,
            'photos'      	=> $photos,
            'podcasts'      => $podcasts,
            'videos'      	=> $videos,
            'delete_forms'	=> $deleteForm
        ));
    }

    public function validateAction($kind, $id){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BackOfficeBundle:' . $kind)->find($id);
        $entity->setValidate(1);
        $entity->setCreated(new \DateTime('now'));

        $em->persist($entity); 
        $em->flush();
        
        return $this->redirect($this->generateUrl('back_office_gestion_validation'));
    }

    public function contenusindexAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$deleteForm = null;
       	$articles 	= $em->getRepository('BackOfficeBundle:Article')->findAll();
       	$photos 	= $em->getRepository('BackOfficeBundle:Photo')->findAll();
       	$podcasts 	= $em->getRepository('BackOfficeBundle:Podcast')->findAll();
       	$videos 	= $em->getRepository('BackOfficeBundle:Video')->findAll();

       	foreach($articles as $entity){
            $deleteForm[] = $this->createDeleteForm($entity->getId())->createView();
        }

        foreach($photos as $entity){
            $deleteForm[] = $this->createDeleteForm($entity->getId())->createView();
        }

        foreach($podcasts as $entity){
            $deleteForm[] = $this->createDeleteForm($entity->getId())->createView();
        }

        foreach($videos as $entity){
            $deleteForm[] = $this->createDeleteForm($entity->getId())->createView();
        }

       	return $this->render('BackOfficeBundle:Gestion:contenusindex.html.twig', array(
            'articles'      => $articles,
            'photos'      	=> $photos,
            'podcasts'      => $podcasts,
            'videos'      	=> $videos,
            'delete_forms'	=> $deleteForm
        ));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    public function usersindexAction() 
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = null;
        $users   = $em->getRepository('BackOfficeBundle:User')->findAll();

        foreach($users as $entity){
            $deleteForm[] = $this->createDeleteForm($entity->getId())->createView();
        }

        return $this->render('BackOfficeBundle:Gestion:usersindex.html.twig', array(
            'users'         => $users,
            'delete_forms'  => $deleteForm
        ));
    }

    public function userdeleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BackOfficeBundle:User')->find($id);

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('back_office_gestion_user'));
    }
}
