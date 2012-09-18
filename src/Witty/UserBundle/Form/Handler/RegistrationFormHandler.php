<?php

namespace Witty\UserBundle\Form\Handler;

use FOS\UserBundle\Form\Handler\RegistrationFormHandler as BaseHandler;

class RegistrationFormHandler extends BaseHandler
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        parent::buildForm($builder, $options);
	
		//Ajout des champs spécifiques à Mwg
        //$builder->add('location');
    }

    public function getName()
    {
        return 'witty_user_registration';
    }
	
}
