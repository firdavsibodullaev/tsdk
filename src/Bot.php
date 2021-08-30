<?php


namespace Firdavs\Tsdk;


use Firdavs\Tsdk\Bot\Updates;
use Firdavs\Tsdk\Bot\Webhook;
use Firdavs\Tsdk\Constants\MainConstants;
use Firdavs\Tsdk\Handler\CatchException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Bot
{
    /** @var Client $request */
    private Client $request;

    /** @var string $token */
    private string $token;

    /**
     * Bot constructor.
     * @param string|null $token
     */
    public function __construct(string $token = null)
    {
        if (!is_null($token)) {
            $this->token = $token;
        } else {
            $token = ""; // Enter token manually
        }
        $this->request = new Client([
            'base_uri' => MainConstants::BASE_URL
        ]);
    }

    /**
     * @param string $token
     * @param string $url
     * @return Webhook
     */
    public function setWebhook(string $url): Webhook
    {
        try {

            $response = $this->request->request("get", "/bot{$this->token}/setWebhook?url={$url}")->getBody();
        } catch (GuzzleException $e) {
            $response = (new CatchException($e))->catch();
        }
        return new Webhook($response);

    }

    public function getUpdates()
    {
        try {
            $response = $this->request->request("get", "/bot{$this->token}/getUpdates")->getBody();
        } catch (GuzzleException $e) {
            $response = (new CatchException($e))->catch();
        }
        return new Updates($response);
    }
}