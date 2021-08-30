<?php


namespace Firdavs\Tsdk;


use Firdavs\Tsdk\Bot\Webhook;
use Firdavs\Tsdk\Constants\MainConstants;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Bot
{
    /** @var Client $request */
    private Client $request;

    public function __construct()
    {
        $this->request = new Client([
            'base_uri' => MainConstants::BASE_URL
        ]);
    }

    /**
     * @param string $token
     * @param string $url
     * @return Webhook
     * @throws GuzzleException
     */
    public function setWebhook(string $token, string $url): Webhook
    {
        $response = $this->request->request("get", "/bot{$token}/setWebhook?url={$url}");

        return new Webhook($response->getBody());
    }
}