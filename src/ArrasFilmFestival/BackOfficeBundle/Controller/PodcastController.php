<?php

namespace ArrasFilmFestival\BackOfficeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ArrasFilmFestival\BackOfficeBundle\Entity\Podcast;

/**
 * Podcast controller.
 *
 */
class PodcastController extends Controller
{
    /**
     * Lists all Podcast entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = null;

        $entities = $em->getRepository('BackOfficeBundle:Podcast')->findAll();

        foreach($entities as $entity){
            $deleteForm[] = $this->createDeleteForm($entity->getId())->createView();
        }
        
        return $this->render('BackOfficeBundle:Podcast:index.html.twig', array(
            'entities'      => $entities,
            'delete_forms'  => $deleteForm,
        ));
    }

    /**
     * Displays a form to create a new Podcast entity.
     *
     */
    public function newAction()
    {
        $entity = new Podcast();
        $form   = $this->createFormEntity($entity);

        return $this->render('BackOfficeBundle:Podcast:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Podcast entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Podcast();
        $form = $this->createFormEntity($entity);
        $form->bind($request);
        $entity->setCreated(new \DateTime('now'));

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('podcast'));
        }

        return $this->render('BackOfficeBundle:Podcast:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Podcast entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackOfficeBundle:Podcast')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException("La Podcast désirée n'existe pas.");
        }

        $editForm = $this->createFormEntity($entity, false);

        return $this->render('BackOfficeBundle:Podcast:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Edits an existing Podcast entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackOfficeBundle:Podcast')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException("La Podcast désirée n'existe pas.");
        }

        $editForm = $this->createFormEntity($entity, false);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('podcast', array('id' => $id)));
        }

        return $this->render('BackOfficeBundle:Podcast:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Podcast entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BackOfficeBundle:Podcast')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException("La Podcast désirée n'existe pas.");
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('podcast'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    private function createFormEntity($entity, $validate = true)
    {  
        return $form = $this->createFormBuilder($entity)
                ->add('title', null, array('label' => 'Titre'))
                ->add('content', null, array('label' => 'Description'))
                ->add('audio', null, array('label' => 'Podcast', 'required' => $validate))
                ->getForm()
        ;
    }
}
