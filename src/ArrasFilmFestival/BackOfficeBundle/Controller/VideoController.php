<?php

namespace ArrasFilmFestival\BackOfficeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;

use \FOS\UserBundle\Model\UserInterface;

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
        $user = $this->get('security.context')->getToken()->getUser();
        $deleteForm = null;

        $query = $em->createQuery('SELECT p FROM BackOfficeBundle:Video p WHERE p.user = :id')->setParameter('id', $user->getId());
        $entities = $query->getResult();

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
        $user = $this->container->get('security.context')->getToken()->getUser();
        $form = $this->createFormEntity($entity);
        $form->bind($request);
        $entity->setCreated(new \DateTime('now'));
        $entity->setUpdated(new \DateTime('now'));
        $entity->setUser($user);
        $entity->setValidate(0);


        if ($this->get('security.context')->isGranted('ROLE_SUPER_ADMIN') || $this->get('security.context')->isGranted('ROLE_POLECOM')) {
            $entity->setValidate(1);
        }

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $aclProvider = $this->get('security.acl.provider');
            $objectIdentity = ObjectIdentity::fromDomainObject($entity);
            $acl = $aclProvider->createAcl($objectIdentity);
            $securityIdentity = UserSecurityIdentity::fromAccount($user);
            $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_OWNER);
            $aclProvider->updateAcl($acl);

            return $this->redirect($this->generateUrl('video'));
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

        if(!$this->get('security.context')->isGranted('ROLE_SUPER_ADMIN')) {
            $securityContext = $this->get('security.context');
            if (false === $securityContext->isGranted('EDIT', $entity)) {
                throw new AccessDeniedException();
            }
        }
        
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

            return $this->redirect($this->generateUrl('video'));
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

        return $this->redirect($this->generateUrl('video'));
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