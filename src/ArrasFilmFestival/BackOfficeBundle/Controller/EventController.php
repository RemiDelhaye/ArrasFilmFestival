<?php

namespace ArrasFilmFestival\BackOfficeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ArrasFilmFestival\BackOfficeBundle\Entity\Event;
use \DateTime;

/**
 * Event controller.
 *
 */
class EventController extends Controller
{
    /**
     * Lists all Event entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = null;
        $query = $em->createQuery('SELECT e FROM BackOfficeBundle:Event e ORDER BY e.startDate ASC');
        $entities = $query->getResult();

        foreach($entities as $entity){
            $deleteForm[] = $this->createDeleteForm($entity->getId())->createView();
        }

        return $this->render('BackOfficeBundle:Event:index.html.twig', array(
            'entities' => $entities,
            'delete_forms'  => $deleteForm,
        ));
    }

    /**
     * Displays a form to create a new Event entity.
     *
     */
    public function newAction()
    {
        $entity = new Event();
        $form   = $this->createFormEntity($entity);

        return $this->render('BackOfficeBundle:Event:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Event entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Event();
        $form = $this->createFormEntity($entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('event'));
        }

        return $this->render('BackOfficeBundle:Event:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Event entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackOfficeBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $editForm = $this->createFormEntity($entity);

        return $this->render('BackOfficeBundle:Event:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Edits an existing Event entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackOfficeBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }


        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createFormEntity($entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('event_edit', array('id' => $id)));
        }

        return $this->render('BackOfficeBundle:Event:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Event entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BackOfficeBundle:Event')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Event entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('event'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    private function createFormEntity($entity)
    {  
        return $form = $this->createFormBuilder($entity)
                        ->add('name', null, array('label' => 'Nom'))
                        ->add('description', null,  array('label' => 'Description'))
                        ->add('lieu', null,  array('label' => 'Lieu'))
                        ->add('startDate', 'datetime', array(
                            'label'         => 'Début', 
                            'input'         => 'datetime',
                            'widget'        => 'single_text',
                            'format'        => 'dd/MM/yyyy hh:mm',
                        ))
                        ->add('endDate', 'datetime', array(
                            'label'         => 'Fin', 
                            'input'         => 'datetime',
                            'widget'        => 'single_text',
                            'format'        => 'dd/MM/yyyy hh:mm',
                        ))
                        ->getForm()
        ;
    }
}
