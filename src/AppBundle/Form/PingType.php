<?php
// src/AppBundle/Form/TaskType.php
namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('domainOrIp', null, array('mapped' => true,'attr'=>array('class'=>'form-control')))
            ->add('ping', SubmitType::class , array('attr'=>array('class'=>'btn btn-primary')))
        ;
    }
}
