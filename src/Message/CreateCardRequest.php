<?php

namespace Ampeco\OmnipayMobilExpress\Message;

class CreateCardRequest extends AbstractRequest
{
    public function getEndpoint()
    {
        return 'StartHostedAccountManagement';
    }

    public function getData()
    {
        $this->validate('email', 'customerId', 'returnUrl');

        return [
            "uiDesignInfo" => [
                "viewType" => "Compact",
                "designType" => 0,
            ],
            "customerInfo" => [
                "email" => $this->getEmail(),
                "customerId" => $this->getCustomerId(),
            ],
            "accountInstruments" => [
                "Card"
            ],
            "accountInstrumentInfo" => [
                "card" => [
                    "posConfiguration" => [
                        "defaultPOS" => 0,
                    ]
                ]
            ],
            "returnUrl" => $this->getReturnUrl(),
        ];
    }
}
