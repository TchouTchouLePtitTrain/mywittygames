<?php

namespace Witty\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfileFormType extends BaseType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->buildUserForm($builder, $options);
    }
    
    public function buildUserForm(FormBuilderInterface $builder, array $options)
    {
		parent::buildUserForm($builder, $options);

        $builder
			->remove('username')
			->remove('plainPassword')
            ->add('plainPassword', 'password', array( 'required' => false, 'always_empty' => true)) //Override du champ password tel que défini dans le FOSUserBundle, pour qu'il ne soit plus 'required' et qu'il soit 'always_empty'
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
            ->add('firstname', 'text', array('required' => false))
            ->add('lastname', 'text', array('required' => false))
            ->add('sex', 'choice', array('required' => false, 'choices' => array( 1 => 'Homme', 0 => 'Femme'), 'expanded' => true, 'multiple' => false))
            ->add('birthdate', 'birthday', array('required' => false, 'format' => 'dd-MM-yyyy'/*, 'years' => array('1920', '1921')*/))
            ->add('address', 'text', array('required' => false))
            ->add('address_2', 'text', array('required' => false))
            ->add('postcode', 'text', array('required' => false))
            ->add('city', 'text', array('required' => false))
            ->add('country', 'text', array('required' => false))
            //->add('country', 'country', array('required' => false))
            ->add('newsletter', 'checkbox', array('value' => 0, 'required' => false))
            ->add('avatarFile', 'file', array('required' => false))
        ;
    }

    public function getName()
    {
        return 'witty_user_profile';
    }
}
