<?php

namespace ArrasFilmFestival\BackOfficeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ArrasFilmFestival\BackOfficeBundle\Entity\Video;

/**
 * Video controller.
 *
 */
class VideoController extends Controller
{
    /**
     * Lists all Video entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = null;

        $entities = $em->getRepository('BackOfficeBundle:Video')->findAll();

        foreach($entities as $entity){
            $deleteForm[] = $this->createDeleteForm($entity->getId())->createView();
        }

        return $this->render('BackOfficeBundle:Video:index.html.twig', array(
            'entities'      => $entities,
            'delete_forms'  => $deleteForm,
        ));
    }

    /**
     * Displays a form to create a new Video entity.
     *
     */
    public function newAction()
    {
        $entity = new Video();
        $form   = $this->createFormEntity($entity);

        return $this->render('BackOfficeBundle:Video:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Video entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Video();
        $form = $this->createFormEntity($entity);
        $form->bind($request);
        $entity->setCreated(new \DateTime('now'));
        $entity->setUpdated(new \DateTime('now'));

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('Video'));
        }

        return $this->render('BackOfficeBundle:Video:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Video entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackOfficeBundle:Video')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException("La Video désirée n'existe pas.");
        }

        $editForm = $this->createFormEntity($entity, false);

        return $this->render('BackOfficeBundle:Video:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Edits an existing Video entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackOfficeBundle:Video')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException("La Video désirée n'existe pas.");
        }

        $editForm = $this->createFormEntity($entity, false);
        $editForm->bind($request);

        $entity->setUpdated(new \DateTime('now'));

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('Video'));
        }

        return $this->render('BackOfficeBundle:Video:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Video entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {

        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BackOfficeBundle:Video')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException("La Video désirée n'existe pas.");
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('Video'));
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
                ->add('video', null, array('label' => 'Vidéo', 'required' => $validate))
                ->getForm()
        ;
    }
}