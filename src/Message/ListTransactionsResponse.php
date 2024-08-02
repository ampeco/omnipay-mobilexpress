<?php

namespace Ampeco\OmnipayMobilExpress\Message;

class ListTransactionsResponse extends Response
{
    public function getTransactions()
    {
        if (!isset($this->data)) {
            return [];
        }

        return $this->data['transactionList'] ?? [];
    }
}
