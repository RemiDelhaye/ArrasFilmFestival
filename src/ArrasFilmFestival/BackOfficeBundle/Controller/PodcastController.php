<?php

namespace ArrasFilmFestival\BackOfficeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ArrasFilmFestival\BackOfficeBundle\Entity\Podcast;
use ArrasFilmFestival\BackOfficeBundle\Form\PodcastType;

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

        $entities = $em->getRepository('BackOfficeBundle:Podcast')->findAll();

        return $this->render('BackOfficeBundle:Podcast:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Podcast entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackOfficeBundle:Podcast')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Podcast entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackOfficeBundle:Podcast:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Podcast entity.
     *
     */
    public function newAction()
    {
        $entity = new Podcast();
        $form   = $this->createForm(new PodcastType(), $entity);

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
        $form = $this->createForm(new PodcastType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('podcast_show', array('id' => $entity->getId())));
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
            throw $this->createNotFoundException('Unable to find Podcast entity.');
        }

        $editForm = $this->createForm(new PodcastType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackOfficeBundle:Podcast:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
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
            throw $this->createNotFoundException('Unable to find Podcast entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PodcastType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('podcast_edit', array('id' => $id)));
        }

        return $this->render('BackOfficeBundle:Podcast:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
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
                throw $this->createNotFoundException('Unable to find Podcast entity.');
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
}
