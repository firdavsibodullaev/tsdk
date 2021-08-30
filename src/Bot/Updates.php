<?php


namespace Firdavs\Tsdk\Bot;


class Updates
{
    /**
     * @var string $updates
     */
    private string $updates;

    public function __construct(string $updates)
    {
        $this->updates = $updates;
    }

    public function json()
    {
        return json_decode($this->updates, true);
    }

    public function object()
    {
        return json_decode($this->updates, false);
    }
}