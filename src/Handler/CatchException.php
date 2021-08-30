<?php


namespace Firdavs\Tsdk\Handler;


use GuzzleHttp\Exception\GuzzleException;

class CatchException
{
    /**
     * @var GuzzleException
     */
    private GuzzleException $exception;

    /**
     * CatchException constructor.
     * @param GuzzleException $exception
     */
    public function __construct(GuzzleException $exception)
    {
        $this->exception = $exception;
    }

    /**
     * @return string
     */
    public function catch(): string
    {
        $this->log();
        return $this->response();
    }

    /**
     * @return string
     */
    public function response(): string
    {
        return $this->exception->getResponse()->getBody(true);
    }


    /**
     * Создаёт лог файл
     */
    private function log()
    {
        $root = $_SERVER["DOCUMENT_ROOT"];
        $trace_string = $this->getLogContent();
        $logs_dir = "{$root}/logs";
        $logs_file = "logs-" . date("d-m-Y") . ".log";
        if (!is_dir($logs_dir)) {
            mkdir($logs_dir);
        }
        $fp = fopen("{$logs_dir}/{$logs_file}", "a");
        fwrite($fp, $trace_string);
        fclose($fp);
    }

    /**
     * @return string
     */
    private function getLogContent(): string
    {
        return "\n[" . date("d-m-Y H:i:s") . "] " . $this->exception->getMessage() . "\n" . $this->exception->getTraceAsString();
    }
}