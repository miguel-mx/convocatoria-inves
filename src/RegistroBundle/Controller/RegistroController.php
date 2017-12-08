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
 * Registro controller.
 *
 * @Route("/registro")
 */
class RegistroController extends Controller
{
    /**
     * Lists all Registro entities.
     *
     * @Route("/", name="registro_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $registros = $em->getRepository('RegistroBundle:Registro')->findAll();

        return $this->render('registro/index.html.twig', array(
            'registros' => $registros,
        ));
    }

    /**
     * Creates a new Registro entity.
     *
     * @Route("/new", name="registro_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {


        $now = new \DateTime();
        $deadline = new \DateTime('2017-11-27');
        if($now >= $deadline){
            return $this->render('registro/closed.html.twig');
        }

        
        $registro = new Registro();
        $form = $this->createForm('RegistroBundle\Form\RegistroType', $registro);
        $form->remove('ref1recomFile');
        $form->remove('ref2recomFile');
        $form->remove('activo');

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $registro->setCreatedAt(new \DateTime());
            $em->persist($registro);
            $em->flush();

            // Obtiene correo y msg de la forma de contacto
            $mailer = $this->get('mailer');

            $message = \Swift_Message::newInstance()
                ->setSubject('Acuse de recibo/Acknowledgment')
                ->setFrom('webmaster@matmor.unam.mx')
                ->setTo(array($registro->getMail()))
                ->setBcc(array('gerardo@matmor.unam.mx','vorozco@matmor.unam.mx'))
                ->setBody($this->renderView('registro/mail.txt.twig', array('entity' => $registro)))
            ;
            $mailer->send($message);

            $message = \Swift_Message::newInstance()
                ->setSubject('Recomendación/Recommendation')
                ->setFrom('webmaster@matmor.unam.mx')
                ->setTo(array($registro->getRef1mail()))
                ->setBcc(array('gerardo@matmor.unam.mx'))
                ->setBody($this->renderView('registro/mailRef.txt.twig', array(
                    'entity' => $registro,
                    'referencia'=>$registro->getRef1nombre(),
                    'mailref'=>$registro->getRef1mail(),
                    'refNum'=>1)))
            ;
            $mailer->send($message);

            $message = \Swift_Message::newInstance()
                ->setSubject('Recomendación/Recommendation')
                ->setFrom('webmaster@matmor.unam.mx')
                ->setTo(array($registro->getRef2mail()))
                ->setBcc(array('gerardo@matmor.unam.mx'))
                ->setBody($this->renderView('registro/mailRef.txt.twig', array(
                    'entity' => $registro,
                    'referencia'=>$registro->getRef2nombre(),
                    'mailref'=>$registro->getRef2mail(),
                    'refNum'=>2)))
            ;
            $mailer->send($message);


            return $this->render('registro/confirm.html.twig', array('id' => $registro->getId(),'entity'=>$registro));

            //return $this->redirectToRoute('registro_show', array('id' => $registro->getId()));
        }

        return $this->render('registro/new.html.twig', array(
            'registro' => $registro,
            'form' => $form->createView(),
        ));
    }


    /**
     * Displays a form to send recommendation file.
     *
     * @Route("/{id}/{ref}/{mail}/{mailref}/recom", name="registro_recom")
     * @Method({"GET", "POST"})
     */
    public function recomAction(Request $request, Registro $registro, $mail, $id, $ref)
    {
        //$deleteForm = $this->createDeleteForm($registro);



        $editForm = $this->createForm('RegistroBundle\Form\RegistroType', $registro);

        $editForm->remove('nombre');
        $editForm->remove('paterno');
        $editForm->remove('materno');
        $editForm->remove('mail');
        $editForm->remove('direccion');
        $editForm->remove('solicitud');
        $editForm->remove('articulos');
        $editForm->remove('proyecto');
        $editForm->remove('activo');
        $editForm->remove('solicitudFile');
        $editForm->remove('cvFile');
        $editForm->remove('comprobanteFile');
        $editForm->remove('proyectoFile');
        $editForm->remove('articulosFile');
        $editForm->remove('ref1nombre');
        $editForm->remove('ref2nombre');
        $editForm->remove('ref2mail');
        $editForm->remove('ref1mail');

        if ($ref ==  1){
            $editForm->remove('ref2recomFile');
            }
        if ($ref == 2){
            $editForm->remove('ref1recomFile');
        }

        $editForm->handleRequest($request);

//        else {

        if ($editForm->isSubmitted() && $editForm->isValid()) {


            $em = $this->getDoctrine()->getManager();

            $registro->setUpdatedAt(new \DateTime());

            $em->persist($registro);
            $em->flush();

            // Obtiene correo y msg de la forma de contacto
            $mailer = $this->get('mailer');

            $message = \Swift_Message::newInstance()
                ->setSubject('Recomendación / Recommendation')
                ->setFrom('webmaster@matmor.unam.mx');

            if ($ref == 1){
                $message->setTo(array($registro->getRef1mail()));
                $refnombre=$registro->getRef1nombre();
            }

            if ($ref == 2){
                $message->setTo(array($registro->getRef2mail()));
                $refnombre=$registro->getRef2nombre();
            }

            $message->setCc(array($registro->getMail()))
                ->setBcc(array('gerardo@matmor.unam.mx'))
                ->setBody($this->renderView('registro/mailCarta.txt.twig', array('entity' => $registro,'refnombre'=>$refnombre)));
            $mailer->send($message);

            //return $this->redirectToRoute('form_edit', array('id' => $registro->getId()));
            return $this->render('registro/confirmCarta.html.twig', array('id' => $registro->getId(), 'entity' => $registro));

        }
        //      }

        if(  $mail != $registro->getMail() || $id != $registro->getId()){

            throw $this->createNotFoundException('Existe algún problema con la información de registro');
        }

        if( ($registro->getRef1recomName() != null) && ($ref==1))
        {
            return $this->render('registro/confirmRecom.html.twig', array('id' => $registro->getId(),'entity'=>$registro));
        }

        if( ($registro->getRef2recomName() != null) && ($ref==2))
        {
            return $this->render('registro/confirmRecom.html.twig', array('id' => $registro->getId(),'entity'=>$registro));
        }
        return $this->render('registro/recom.html.twig', array(
            'registro' => $registro,
            'edit_form' => $editForm->createView(),
            //'delete_form' => $deleteForm->createView(),
        ));
    }




    /**
     * Finds and displays a Registro entity.
     *
     * @Route("/{id}", name="registro_show")
     * @Method("GET")
     */
    public function showAction(Registro $registro)
    {
        $deleteForm = $this->createDeleteForm($registro);

        return $this->render('registro/show.html.twig', array(
            'registro' => $registro,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Registro entity.
     *
     * @Route("/{id}/edit", name="registro_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Registro $registro)
    {
        $deleteForm = $this->createDeleteForm($registro);
        $editForm = $this->createForm('RegistroBundle\Form\RegistroType', $registro);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($registro);
            $em->flush();

            return $this->redirectToRoute('registro_edit', array('id' => $registro->getId()));
        }

        return $this->render('registro/edit.html.twig', array(
            'registro' => $registro,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Registro entity.
     *
     * @Route("/{id}", name="registro_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Registro $registro)
    {
        $form = $this->createDeleteForm($registro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($registro);
            $em->flush();
        }

        return $this->redirectToRoute('registro_index');
    }

    /**
     * Creates a form to delete a Registro entity.
     *
     * @param Registro $registro The Registro entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Registro $registro)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('registro_delete', array('id' => $registro->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }




}
