<?php

namespace Ampeco\OmnipayMobilExpress;

use Ampeco\OmnipayMobilExpress\Message\PurchaseRequest;
use Ampeco\OmnipayMobilExpress\Message\CreateCardRequest;
use Ampeco\OmnipayMobilExpress\Message\DeleteCardRequest;
use Ampeco\OmnipayMobilExpress\Message\ListTransactionsRequest;
use Ampeco\OmnipayMobilExpress\Message\ListCardsRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\RequestInterface;

/**
 * @method \Omnipay\Common\Message\NotificationInterface acceptNotification(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface authorize(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface capture(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface refund(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface fetchTransaction(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface void(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface createCard(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = [])
 */
class Gateway extends AbstractGateway
{
    use CommonParameters;

    public function getName()
    {
        return 'MobilExpress';
    }

    public function capture(array $options = []): RequestInterface
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    public function purchase(array $options = []): RequestInterface
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    public function createCard(array $options = []): RequestInterface
    {
        return $this->createRequest(CreateCardRequest::class, $options);
    }

    public function deleteCard(array $options = []): RequestInterface
    {
        return $this->createRequest(DeleteCardRequest::class, $options);
    }

    public function listTransaction(array $options = []): RequestInterface
    {
        return $this->createRequest(ListTransactionsRequest::class, $options);
    }

    public function listCards(array $options = []): RequestInterface
    {
        return $this->createRequest(ListCardsRequest::class, $options);
    }
}
