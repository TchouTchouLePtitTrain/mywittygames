<?php

namespace Witty\TransactionBundle\Service;

use Witty\TransactionBundle\Entity\Transaction;

/**
 * Manages payments
 *
 */
class PaymentManager
{
    protected $adapter;

    /**
     * Constructor
     *
     * @param  Adapter $adapter A configured Adapter instance
     */
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Returns the adapter
     *
     * @return Adapter
     */
    public function getAdapter()
    {
        return $this->adapter;
    }
	
    /**
     * Paye
     *
     * @return Adapter
     */	
	public function pay($transaction)
	{
		return $this->adapter->pay($transaction);
	}
}
