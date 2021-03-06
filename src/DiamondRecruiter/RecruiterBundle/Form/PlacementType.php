<?php

namespace DiamondRecruiter\RecruiterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlacementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('startDate')
            ->add('endDate')
            ->add('submission')
            ->add('submit',SubmitType::class, [
                'label' => 'Create Placement',
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
            'data_class' => 'DiamondRecruiter\RecruiterBundle\Entity\Placement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'diamondrecruiter_recruiterbundle_placement';
    }


}
