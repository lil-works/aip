<?php
// src/AppBundle/Form/TaskType.php
namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class PdfType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class, array('label' => 'PDF file' ,  'attr' => array('class'=>'btn btn-default btn-file')))
            ->add('compress', SubmitType::class , array('attr'=>array('class'=>'btn btn-primary')))
        ;
    }
}
