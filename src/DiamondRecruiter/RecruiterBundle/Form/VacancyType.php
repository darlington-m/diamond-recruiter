<?php

namespace DiamondRecruiter\RecruiterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VacancyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('location')
            ->add('minimumSalary')
            ->add('maximumSalary')
            ->add('currency')
            ->add('expirationDate')
            ->add('date')
            ->add('jobDescription')
            ->add('jobUrl')
            ->add('client')
            ->add('submit',SubmitType::class, [
                'label' => 'Create Vacancy',
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
            'data_class' => 'DiamondRecruiter\RecruiterBundle\Entity\Vacancy'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'diamondrecruiter_recruiterbundle_vacancy';
    }


}
