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
        $this->validate('transactionId', 'amount', 'currency', 'token', 'email', 'customerId', 'posId');

        // TODO: Where should we put the description (bank statement?)
        return [
            "orderId" => $this->getTransactionId(),
            "totalAmount" => $this->getAmount(),
            "currency" => $this->getCurrency(),
            "customerInfo" => [
                "email" => $this->getEmail(),
                "customerId" => $this->getCustomerId(),
            ],
            "paymentInstrument"=> "StoredCard",
            "paymentInstrumentInfo" => [
                "storedCard" => [
                    "processType" => "sales",
                    "cardToken" => $this->getToken(),
                    "use3DSecure" => false,
                    "posAccount" => [
                        "id" => $this->getPosId(),
                    ],
                ]
            ],
            "basketItems"=> [
                [
                    "name" => $this->getDescription(),
                ]
            ]
        ];
    }
}
