<?php

namespace Ampeco\OmnipayMobilExpress\Message;

class ListTransactionsResponse extends Response
{
    public function getTransactions()
    {
        return $this->data['transactionList'] ?? [];
    }
}
