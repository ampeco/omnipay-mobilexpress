<?php

namespace Ampeco\OmnipayMobilExpress\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\ResponseInterface;

class Response extends AbstractResponse implements ResponseInterface, RedirectResponseInterface
{

    /**
     * Request id
     *
     * @var string URL
     */
    protected $requestId = null;

    /**
     * @var array
     */
    protected $headers = [];

    public function __construct(RequestInterface $request, $data, $headers = [])
    {
        $this->request = $request;
        $this->data = json_decode($data, true);
        $this->headers = $headers;
    }

    public function isSuccessful()
    {
        return $this->data['result'] === 'Success';
    }

    public function isRedirect()
    {
        return !is_null($this->getRedirectUrl());
    }

    public function getRedirectUrl()
    {
        return isset($this->data['redirectURL']) ? $this->data['redirectURL'] : null;
    }

    public function getTransactionReference()
    {
        if (! $this->isSuccessful()) {
            return null;
        }

        return $this->data['systemTransId'] ?? $this->data['paymentInfo']['systemTransId'] ?? null;
    }

    public function getMessage()
    {
        return $this->data['resultMessage'] ??= '';
    }
}
