<?php

namespace RegistroBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RegistroBundle\Entity\Registro;
use RegistroBundle\Form\RegistroType;

/**
 * Register controller.
 *
 * @Route("/admin")

 * @Method("GET")
 * @Template()
 */

class AdminController extends Controller
{
    /**
     * Lists all Register entities.
     *
     * @Route("/", name="admin")
     * @Template("admin/login.html.twig")
     */
    public function indexAction()
    {

        // Redirecto to registro/index
        return $this->redirectToRoute('registro_index');

//        $em = $this->getDoctrine()->getManager();
//
//        $registros = $em->getRepository('RegistroBundle:Registro')->findAll();
//        #$registros = $em->getRepository('RegistroBundle:Registro')->findByActivo(1);
//
//        return $this->render('registro/index.html.twig', array(
//            'registros' => $registros,
//        ));
    }


    /**
     * Displays a form to edit an existing Referencia entity.
     *
     * @Route("/{id}/eval", name="form_eval")
     * @Template("admin/eval.html.twig")
     * @Method({"GET", "POST"})
     */
    public function evalAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('RegistroBundle:Registro')->find($id);

        $formEval = $this->createFormBuilder($entity)

            ->add('activo', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                'choices'=>array(
                    true=>'Si',
                    false=>'No'),
                'expanded'=>true,
                'required'=>false,
                'placeholder'=>false,
            ))
            ->add('biomat', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                'choices'=>array(
                    true=>'Si',
                    false=>'No'),
                'expanded'=>true,
                'required'=>false,
                'placeholder'=>false,
            ))
            ->getForm();

        $formEval->handleRequest($request);

        if ($formEval->isSubmitted() && $formEval->isValid()) {

                $em->persist($entity);
                $em->flush();

            return $this->redirectToRoute('registro_show', array('id' => $id));
        }
        // $form   = $this->createForm($formEval, $entity);
        return $this->render('admin/eval.html.twig', array('form' => $formEval->createView(),'registro'=> $entity));
        //return $this->redirect($this->generateUrl('registro_show', array('id' => $id)));

    }


    /**
     * Displays a list of mails
     *
     * @Route("/eval/mails", name="mails")
     * @Template()
     */
    public  function mailAction()
    {
        $em = $this->getDoctrine()->getManager();
        $registros = $em->getRepository('RegistroBundle:Form')->findAll();

        //return $this->render('CcmEmmbioBundle:Regs:mails.html.twig', array('entities' => $entities));

    }


    /**
     * Lists all Registro entities.
     *
     * @Route("/consulta", name="registro_cv")
     * @Method("GET")
     */
    public function cvAction()
    {
        $em = $this->getDoctrine()->getManager();

        $registros = $em->getRepository('RegistroBundle:Registro')->findAll();

        return $this->render('registro/consulta.html.twig', array(
            'registros' => $registros,
        ));
    }

}
