<?php

namespace Ampeco\OmnipayMobilExpress\Message;

use Ampeco\OmnipayMobilExpress\CommonParameters;
use Omnipay\Common\Http\Exception\NetworkException;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    use CommonParameters;

    // const ENDPOINT_PRODUCTION = 'https://api.lidio.com/';
    // const ENDPOINT_TESTING = 'https://test.lidio.com/api/';

    const ENDPOINT_PRODUCTION = 'https://api.mobilexpress.com.tr/';
    const ENDPOINT_TESTING = 'https://testapi.mobilexpress.com.tr/';

    abstract public function getEndpoint();

    public function getBaseUrl()
    {
        return $this->getTestMode() ? self::ENDPOINT_TESTING : self::ENDPOINT_PRODUCTION;
    }

    public function getHeaders(): array
    {
        $headers = [];

        return $headers;
    }

    public function getHttpMethod()
    {
        return 'POST';
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data)
    {
        $headers = array_merge($this->getHeaders(), [
            'Authorization' => $this->getApiKey(),
            'MerchantCode' => $this->getMerchantCode(),
            'Content-Type' => 'application/json',
        ]);

        try {
            $httpResponse = $this->httpClient->request(
                $this->getHttpMethod(),
                $this->getBaseUrl() . ltrim($this->getEndpoint(), '/'),
                $headers,
                json_encode($data),
            );
            $responseData = $httpResponse->getBody()->getContents();
        } catch (NetworkException $e) {
            $responseData = '';
        }

        return $this->createResponse($responseData, $httpResponse->getHeaders());
    }

    public function getEmail()
    {
        return $this->getParameter('email');
    }

    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }

    public function getCustomerId()
    {
        return $this->getParameter('customerId');
    }

    public function setCustomerId($value)
    {
        return $this->setParameter('customerId', $this->prefix($value));
    }

    public function setTransactionId($value)
    {
        return $this->setParameter('transactionId', $this->prefix($value));
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new Response($this, $data, $headers);
    }

    protected function prefix($value)
    {
        if ($this->getTestMode() && !is_null($this->getTransactionPrefix())) {
            return $this->getTransactionPrefix() . $value;
        }

        return $value;
    }
}
