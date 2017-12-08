<?php

namespace RegistroBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistroType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'required'=>true,
            ))
            ->add('paterno', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'required'=>true,
            ))
            ->add('materno', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'required'=>false,
            ))

            ->add('direccion', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'required'=>true,
            ))
            ->add('mail', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'required'=>true,
            ))
            ->add('solicitudFile', 'vich_file', array(
                'required'      => true,
                'label' => '*Carta Solicitud'
            ))
            ->add('cvFile', 'vich_file', array(
                'required'      => true,
                'label' => '*Currículum Vitae'
            ))
            ->add('comprobanteFile', 'vich_file', array(
                'required'      => true,
                'label' => '*Comprobante oficial de grado'
            ))
            ->add('proyectoFile', 'vich_file', array(
                'required'      => true,
                'label' => '*Proyecto de investigación'
            ))
            ->add('articulosFile', 'vich_file', array(
                'required'      => true,
                'label' => '*Sobretiros de artículos publicados y versiones preliminares de artículos aceptados'
            ))
            ->add('ref1nombre', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'required'=>true,
            ))
            ->add('ref1mail', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'required'=>true,
            ))
            ->add('ref1recomFile', 'vich_file', array(
                'required'      => true,
                'label' => 'Recomendación',
                'allow_delete'  => false,
            ))
            ->add('ref2nombre', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'required'=>true,
            ))
            ->add('ref2mail', 'Symfony\Component\Form\Extension\Core\Type\TextType',array(
                'required'=>true,
            ))
            ->add('ref2recomFile', 'vich_file', array(
                'required'      => true,
                'label' => 'Recomendación'
            ))
            ->add('activo')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RegistroBundle\Entity\Registro'
        ));
    }
}
