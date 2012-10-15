<?php

namespace Witty\UserBundle\Form\Handler;

use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Form\Handler\RegistrationFormHandler as BaseHandler;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Util\TokenGeneratorInterface;
use FOS\UserBundle\Mailer\MailerInterface;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class RegistrationFormHandler extends BaseHandler
{
    public function __construct(FormInterface $form, Request $request, UserManagerInterface $userManager, MailerInterface $mailer, TokenGeneratorInterface $tokenGenerator)
    {
        parent::__construct($form, $request, $userManager, $mailer, $tokenGenerator);
    }
	
    public function process($confirmation = false)
    {
		if (!$this->form->isBound())
		{
			$user = $this->createUser();
			$this->form->setData($user);

			if ($this->request->get('fos_user_registration_form') && ('POST' === $this->request->getMethod()) )
			{
				//Si le pseudo n'est pas renseign�, on le ne transmet pas
				if (
					isset($this->request->get('fos_user_registration_form')['username']) 
					&& (
						($this->request->get('fos_user_registration_form')['username'] == "") 
						|| ($this->request->get('fos_user_registration_form')['username'] == null) )
					)
				{
					$parametres_requete = $this->request->get('fos_user_registration_form');
					$parametres_requete['username'] = $parametres_requete['email']; //substr($parametres_requete['email'], 0, strpos($parametres_requete['email'], '@')); //On ne garde pas unqiuement le d�but de l'adresse mail pour assurer l'unicit� du username
					$this->request->request->set('fos_user_registration_form', $parametres_requete);
				}
				
				$this->form->bindRequest($this->request);

				if ($this->form->isValid()) {

					$this->onSuccess($user, $confirmation);

					return true;
				}
			}
		}
			
        return false;
    }
}
