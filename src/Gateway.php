<?php

namespace Ampeco\OmnipayMobilExpress;

use Ampeco\OmnipayMobilExpress\Message\CaptureRequest;
use Ampeco\OmnipayMobilExpress\Message\PurchaseRequest;
use Ampeco\OmnipayMobilExpress\Message\CreateCardRequest;
use Ampeco\OmnipayMobilExpress\Message\DeleteCardRequest;
use Ampeco\OmnipayMobilExpress\Message\ListTransactionsRequest;
use Ampeco\OmnipayMobilExpress\Message\ListCardsRequest;
use Ampeco\OmnipayMobilExpress\Message\VoidRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\RequestInterface;

/**
 * @method \Omnipay\Common\Message\NotificationInterface acceptNotification(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface refund(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface fetchTransaction(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = [])
 */
class Gateway extends AbstractGateway
{
    use CommonParameters;

    const PROCESS_TYPE_PREAUTH = 'preauth';
    const PROCESS_TYPE_SALES = 'sales';

    public static function processTypes()
    {
        return [
            static::PROCESS_TYPE_PREAUTH,
            static::PROCESS_TYPE_SALES,
        ];
    }

    public function getName()
    {
        return 'MobilExpress';
    }

    public function authorize(array $options = []): RequestInterface
    {
        return $this->createRequest(PurchaseRequest::class, array_merge($options, [
            'processType' => static::PROCESS_TYPE_PREAUTH,
        ]));
    }

    public function capture(array $options = []): RequestInterface
    {
        return $this->createRequest(CaptureRequest::class, $options);
    }

    public function void(array $options = []): RequestInterface
    {
        return $this->createRequest(VoidRequest::class, $options);
    }

    public function purchase(array $options = []): RequestInterface
    {
        return $this->createRequest(PurchaseRequest::class, array_merge($options, [
            'processType' => static::PROCESS_TYPE_SALES,
        ]));
    }

    public function createCard(array $options = []): RequestInterface
    {
        return $this->createRequest(CreateCardRequest::class, $options);
    }

    public function deleteCard(array $options = []): RequestInterface
    {
        return $this->createRequest(DeleteCardRequest::class, $options);
    }

    public function listCards(array $options = []): RequestInterface
    {
        return $this->createRequest(ListCardsRequest::class, $options);
    }

    public function listTransactions(array $options = []): RequestInterface
    {
        return $this->createRequest(ListTransactionsRequest::class, $options);
    }
}
