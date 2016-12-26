<?php
// src/AppBundle/Form/TaskType.php
namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\File;

class PdfType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class, array(
                'label' => 'PDF file' ,
                'attr' => array('class'=>'btn btn-default btn-file'),
                    'constraints' => [
                        new File([
                            'maxSize' => '80M',
                            'mimeTypes' => [
                                'application/pdf',
                                'application/x-pdf',
                            ],
                            'mimeTypesMessage' => 'Please upload a valid PDF',
                        ])
                    ]
                )
            )
            ->add('compress', SubmitType::class , array('attr'=>array('class'=>'btn btn-primary')))
        ;
    }
}
