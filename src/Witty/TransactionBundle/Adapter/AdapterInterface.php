<?php

namespace Witty\TransactionBundle\Adapter;


interface AdapterInterface
{
	//Traitement du formulaire envoy� � Paypal
	public function success();
}
