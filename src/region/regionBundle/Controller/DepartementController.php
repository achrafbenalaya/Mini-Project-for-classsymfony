<?php

namespace region\regionBundle\Controller;

use region\regionBundle\Entity\Departement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Departement controller.
 *
 * @Route("departement")
 */
class DepartementController extends Controller
{
    /**
     * Lists all departement entities.
     *
     * @Route("/", name="departement_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $departements = $em->getRepository('regionBundle:Departement')->findAll();

        return $this->render('departement/index.html.twig', array(
            'departements' => $departements,
        ));
    }

    /**
     * Creates a new departement entity.
     *
     * @Route("/new", name="departement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $departement = new Departement();
        $form = $this->createForm('region\regionBundle\Form\DepartementType', $departement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($departement);
            $em->flush();

            return $this->redirectToRoute('departement_show', array('id' => $departement->getId()));
        }

        return $this->render('departement/new.html.twig', array(
            'departement' => $departement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a departement entity.
     *
     * @Route("/{id}", name="departement_show")
     * @Method("GET")
     */
    public function showAction(Departement $departement)
    {
        $deleteForm = $this->createDeleteForm($departement);

        return $this->render('departement/show.html.twig', array(
            'departement' => $departement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing departement entity.
     *
     * @Route("/{id}/edit", name="departement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Departement $departement)
    {
        $deleteForm = $this->createDeleteForm($departement);
        $editForm = $this->createForm('region\regionBundle\Form\DepartementType', $departement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('departement_edit', array('id' => $departement->getId()));
        }

        return $this->render('departement/edit.html.twig', array(
            'departement' => $departement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a departement entity.
     *
     * @Route("/{id}", name="departement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Departement $departement)
    {
        $form = $this->createDeleteForm($departement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($departement);
            $em->flush();
        }

        return $this->redirectToRoute('departement_index');
    }

    /**
     * Creates a form to delete a departement entity.
     *
     * @param Departement $departement The departement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Departement $departement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('departement_delete', array('id' => $departement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
