<?php

namespace Witty\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

		parent::buildForm($builder, $options);

        $builder
			->remove('username')
			->remove('plainPassword')
			/*
			->add('email', 'repeated', array(
                'type' => 'email',
                'options' => array('translation_domain' => 'FOSUserBundle', 'required' => true),
                'first_options' => array('label' => 'form.email'),
                'second_options' => array('label' => 'form.email_confirmation'),
            ))*/
			->add('plainPassword', 'password', array('translation_domain' => 'FOSUserBundle', 'required' => true, 'label' => 'form.password'))
			->add('username', 'text', array('label' => 'Pseudo', 'required' => false))
        ;
    }

    public function getName()
    {
        return 'witty_user_registration';
    }
}
