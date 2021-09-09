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
                "designType" => 2, // [0 red, 1 yellow, 2 black] - same design, 4 better design
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
                    "processType" => "preauth",
                    // "threeDSecureMode" => "Mandatory",
                ]
            ],
            "returnUrl" => $this->getReturnUrl(),
        ];
    }
}
