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

			if ($this->request->get('fos_user_registration_form'))
			{
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
