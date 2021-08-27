<?php

namespace Ampeco\OmnipayMobilExpress\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\ResponseInterface;

class Response extends AbstractResponse implements ResponseInterface
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

    public function getTransactionReference()
    {
        return $this->data['paymentInfo'] ? $this->data['paymentInfo']['systemTransId'] : '';
    }
    public function getMessage()
    {
        return $this->data['resultMessage'];
    }
    public function getCode()
    {
        return $this->data['resultDetail'];
    }
}
