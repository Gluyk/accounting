<?php

namespace Accounting\IDokladSdk\Mails\ProformaInvoice;

class ProformaInvoiceSend
{
    public function __construct(
        private readonly int $documentId,
        private readonly bool $sendToAccountant,
        private readonly bool $sendToSelf,
        private readonly bool $sendToPartner,
        private readonly int $method,
    ) {
    }

    public function getDocumentId(): int
    {
        return $this->documentId;
    }

    public function isSendToAccountant(): bool
    {
        return $this->sendToAccountant;
    }

    public function isSendToSelf(): bool
    {
        return $this->sendToSelf;
    }

    public function isSendToPartner(): bool
    {
        return $this->sendToPartner;
    }

    public function getMethod(): int
    {
        return $this->method;
    }
}
