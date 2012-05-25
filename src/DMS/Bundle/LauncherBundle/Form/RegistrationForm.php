<?php

namespace DMS\Bundle\LauncherBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', null, array(
                'label' => 'Enter your email to be the first to know when we launch!'
            ))
            ->add('username', null, array(
                'label' => 'Reserve your username for our launch!'
            ))
            ->add('referrerToken', 'hidden')
            ->add('referrerUrl', 'hidden')
        ;
    }

    public function getName()
    {
        return 'dms_bundles_launcherbundle_registration';
    }
}
