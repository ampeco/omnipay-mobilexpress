<?php
namespace Ampeco\OmnipayMobilExpress\Message;
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{

    const ENDPOINT_PRODUCTION = 'https://api.mobilexpress.com.tr/';
    const ENDPOINT_TESTING = 'https://testapi.mobilexpress.com.tr/';

    /**
     * Get the gateway API Key.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    /**
     * Set the gateway API Key.
     *
     * @return AbstractRequest provides a fluent interface.
     */
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * Get the gateway merchant code.
     *
     * @return string
     */
    public function getMerchantCode()
    {
        return $this->getParameter('merchantCode');
    }

    /**
     * Set the gateway metchant code
     *
     * @return AbstractRequest provides a fluent interface.
     */
    public function setMerchantCode($value)
    {
        return $this->setParameter('merchantCode', $value);
    }

    public function getBaseUrl(){
        return $this->getTestMode() ? self::ENDPOINT_TESTING : self::ENDPOINT_PRODUCTION;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        $headers = array();


        return $headers;
    }

    abstract public function getEndpoint();

    public function getHttpMethod() {
        return 'POST';
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data)
    {
        $headers = array_merge(
            $this->getHeaders(),
            [
                'Authorization' => 'MxS2S ' . base64_encode($this->getApiKey()),
                'MerchantCode' => $this->getMerchantCode(),
                'Content-Type' => 'application/json',
            ],
        );

        $body = $data;
        $httpResponse = $this->httpClient->request(
            $this->getHttpMethod(),
            $this->getBaseUrl().ltrim($this->getEndpoint(), '/'),
            $headers,
            $body,
        );

        return $this->createResponse($httpResponse->getBody()->getContents(), $httpResponse->getHeaders());
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new Response($this, $data, $headers);
    }
}
