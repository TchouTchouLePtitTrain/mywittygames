<?php

namespace Witty\UserBundle\Form\Handler;

use FOS\UserBundle\Form\Handler\ProfileFormHandler as BaseHandler;

class ProfileFormHandler extends BaseHandler
{

    //public function buildForm(FormBuilder $builder, array $options)
	public function buildUserForm(FormBuilder $builder, array $options)
    {
die('ok');
        //parent::buildForm($builder, $options);
		parent::buildUserForm($builder, $options);
	
		//Ajout des champs spécifiques à Mwg
        $builder->add('firstname');
        $builder->add('lastname');
        $builder->add('sex');
        $builder->add('birthdate');
        $builder->add('address');
        $builder->add('address_2');
        $builder->add('postcode');
        $builder->add('city');
        $builder->add('country');
        $builder->add('newsletter');

    }

    //public function buildForm(FormBuilder $builder, array $options)
	public function buildForm(FormBuilder $builder, array $options)
    {
die('ok');

    }
	
    public function getName()
    {
        return 'witty_user_editing';
    }
}
