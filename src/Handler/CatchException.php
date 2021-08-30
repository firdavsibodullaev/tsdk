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

    public function catch()
    {
        $this->log();
        return $this->response();
    }

    public function response(): string
    {
        return $this->exception->getMessage();
    }


    private function log()
    {
        $root = $_SERVER["DOCUMENT_ROOT"];
        $trace_string = "\n[" . date("d-m-Y H:i:S") . "] " . $this->response() . "\n" . $this->exception->getTraceAsString();

        $trace_string = preg_replace("/\s#/", "\n#", $trace_string);

        $logs_dir = "{$root}/logs";
        $logs_file = "logs-" . date("d-m-Y") . ".log";
        if (!is_dir($logs_dir)) {
            mkdir($logs_dir);
        }
        $fp = fopen("{$logs_dir}/{$logs_file}", "a");
        fwrite($fp, $trace_string);
        fclose($fp);
    }
}