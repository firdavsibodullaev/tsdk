<?php


namespace Firdavs\Tsdk\Constants\Bot;


class Webhook
{


    /**
     * @var mixed
     */
    private $data;

    public function __construct(string $data)
    {
        $this->data = json_decode($data, true);
    }

    /**
     * @return int
     */
    public function code(): int
    {
        return $this->data["ok"] ? 200 : 429;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->data["ok"];
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return $this->data['description'];
    }
}