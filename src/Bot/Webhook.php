<?php


namespace Firdavs\Tsdk\Bot;


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
        return $this->data["ok"] ? 200 : $this->data['error_code'];
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->data["ok"] === true;
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return $this->data['description'];
    }
}