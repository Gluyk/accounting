<?php

namespace Accounting\IDokladSdk;

use GuzzleHttp;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SendAuthorizationRequestHandler
{
    public function __construct(
        private readonly GuzzleHttp\Client $client = new GuzzleHttp\Client(),
    ) {
    }

    public function __invoke(SendAuthorizationRequest $message): string
    {
        try {
            $response = $this->client->post(
                $message->getUrl() . 'server/connect/token',
                [
                    GuzzleHttp\RequestOptions::FORM_PARAMS => [
                        'grant_type' => 'client_credentials',
                        'client_id' => $message->getConfigurationParams()->get('clientId'),
                        'client_secret' => $message->getConfigurationParams()->get('clientSecret'),
                        'scope' => 'idoklad_api',
                    ],
                ]
            );
            $contents = $response->getBody()->getContents();
        } catch (GuzzleException $e) {
            throw new CustomResponseException($e->getMessage());
        }

        return $contents;
    }
}
