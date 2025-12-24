<?php

namespace Ampeco\OmnipayMobilExpress;

trait CommonParameters
{
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    public function getMerchantCode()
    {
        return $this->getParameter('merchantCode');
    }

    public function setMerchantCode($value)
    {
        return $this->setParameter('merchantCode', $value);
    }

    public function getPosId()
    {
        return $this->getParameter('posId');
    }

    public function setPosId($value)
    {
        return $this->setParameter('posId', $value);
    }

    public function getTransactionPrefix()
    {

        return $this->getParameter('TransactionPrefix');
    }

    public function setTransactionPrefix($value)
    {
        return $this->setParameter('TransactionPrefix', $value);
    }

    public function getDesignType()
    {
        return $this->getParameter('designType');
    }

    public function setDesignType($value)
    {
        return $this->setParameter('designType', $value);
    }
}
