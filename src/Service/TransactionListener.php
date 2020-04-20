<?php


namespace App\Service;


use App\Entity\Transaction;
use Doctrine\ORM\Event\LifecycleEventArgs;

class TransactionListener
{
    public $cacheDriver;

    public function __construct($cacheDriver)
    {
        $this->cacheDriver = $cacheDriver;
    }

    public function postPersist(Transaction $transaction, LifecycleEventArgs $args)
    {
        $this->cacheDriver->expire('[App\\Entity\\Transaction$CLASSMETADATA][1]', 0);
    }

    public function postUpdate(Transaction $transaction, LifecycleEventArgs $args)
    {
        $this->cacheDriver->expire('[App\\Entity\\Transaction$CLASSMETADATA][1]', 0);
    }

    public function postRemove(Transaction $transaction, LifecycleEventArgs $args)
    {
        $this->cacheDriver->expire('[App\\Entity\\Transaction$CLASSMETADATA][1]', 0);
    }
}