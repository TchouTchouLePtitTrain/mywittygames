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
			->add('plainPassword', 'repeated', array( //Override du champ password tel que défini dans le FOSUserBundle, pour qu'il ne soit plus 'required' et qu'il soit 'always_empty'
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle', 'required' => false),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
            ))
            //->add('firstname')
            ->add('lastname')
            ->add('sex', 'choice', array('choices' => array( 1 => 'Homme', 0 => 'Femme'), 'expanded' => true, 'multiple' => false))
            ->add('birthdate')
            ->add('address')
            ->add('address_2')
            ->add('postcode')
            ->add('city')
            ->add('country')
            ->add('newsletter', 'checkbox', array('value' => 0, 'required' => false))
        ;
    }

    public function getName()
    {
        return 'witty_user_registration';
    }
}
