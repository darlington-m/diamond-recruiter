<?php

namespace DiamondRecruiter\RecruiterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidateType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullname')
            ->add('firstname')
            ->add('surname')
            ->add('phoneNumber')
            ->add('email')
            ->add('profession')
            ->add('skills', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Comma seperated'
                ]
            ])
            ->add('contacted')
            ->add('available')
            ->add('looking')
            ->add('placed')
            ->add('cv', FileType::class, [
                'data_class' => null,
                'label' => 'Curriculum Vitae',
                'attr' => [
                    'class' => 'btn btn-default btn-file'
                ]])
            ->add('avatar', FileType::class, [
                'data_class' => null,
                'label' => 'Image',
                'attr' => [
                    'class' => 'btn btn-default btn-file'
                ]])
            ->add('submit',SubmitType::class, [
                'label' => 'Create Candidate',
                'attr' => [
                    'class' => 'btn-primary'
                ]])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DiamondRecruiter\RecruiterBundle\Entity\Candidate'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'diamondrecruiter_recruiterbundle_candidate';
    }


}
