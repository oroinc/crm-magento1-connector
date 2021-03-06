<?php
declare(strict_types=1);

namespace Oro\Bundle\MagentoBundle\EventListener;

use Oro\Bundle\AccountBundle\Event\CollectAccountWebsiteActivityCustomersEvent;
use Symfony\Bridge\Doctrine\ManagerRegistry;

class CollectAccountWebsiteActivityCustomersListener
{
    /** @var ManagerRegistry */
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function onAccountView(CollectAccountWebsiteActivityCustomersEvent $event)
    {
        $customers = $this->doctrine
            ->getRepository('OroMagentoBundle:Customer')
            ->findBy(['account' => $event->getAccountId()]);
        $event->setCustomers($customers);
    }
}
