<?php
// src/AppBundle/Form/TaskType.php
namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\File;

class VideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', UrlType::class, array(
                'label' => 'Video URL' ,
                'attr' => array('class'=>'form-control'),
                    'mapped'=>true
                )
            )
            ->add('See available format', SubmitType::class , array('attr'=>array('class'=>'btn btn-primary')))
        ;
    }
}
