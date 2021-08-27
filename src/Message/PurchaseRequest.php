<?php

namespace Ampeco\OmnipayMobilExpress\Message;

class PurchaseRequest extends AbstractRequest
{

    public function getEndpoint()
    {
        return 'ProcessPayment';
    }

    public function getData()
    {
        $this->validate('orderId', 'amount', 'currency', 'cardReference');

        $data = array();

        $data['orderId'] = $this->getTransactionId();
        $data['totalAmount'] = $this->getAmount();
        $data['currency'] = $this->getCurrency();
        $data['paymentInstrument'] = 'StoredCard';
        $data['paymentInstrumentInfo'] = ['storedCard' => [
            'processType' => 'sales',
            'cardToken' => $this->getCardReference(),
            'use3DSecure' => false,
        ]];
        // TODO: Where should we put the description (bank statement?)
    }
}
