<?php

namespace Accounting\IDokladSdk;

class BaseResponseEnvelopeDTO
{
    public mixed $data = null;
    public int $errorCode;
    public bool $isSuccess;
    public string $message;
    public int $statusCode;
}
