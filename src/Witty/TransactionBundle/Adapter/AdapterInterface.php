<?php

namespace Witty\TransactionBundle\Adapter;


interface AdapterInterface
{
	//Traitement du formulaire envoyé à Paypal
	public function success();
}
