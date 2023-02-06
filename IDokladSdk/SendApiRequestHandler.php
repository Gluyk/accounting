<?php

namespace Accounting\IDokladSdk;

use GuzzleHttp;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SendApiRequestHandler
{
    public function __construct(
        private readonly GuzzleHttp\Client $client = new GuzzleHttp\Client(),
    ) {
    }

    public function __invoke(SendApiRequest $message): string
    {
        try {
            $response = $this->client->request(
                $message->getRequestsMethod(),
                $message->getUrl() . $message->getPath(),
                $message->getRequestBody()
            );
            $contents = $response->getBody()->getContents();
        } catch (GuzzleException $e) {
            throw new CustomResponseException($e->getMessage());
        }

        return $contents;
    }
}
