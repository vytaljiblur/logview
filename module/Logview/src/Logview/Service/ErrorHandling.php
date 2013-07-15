<?php
/**
 * Created by JetBrains PhpStorm.
 * User: vitaliji
 * Date: 15/07/13
 * Time: 14:15
 * To change this template use File | Settings | File Templates.
 */

namespace Logview\Service;

class ErrorHandling
{
    protected $logger;

    function __construct($logger)
    {
        $this->logger = $logger;
    }

    function logException(\Exception $e)
    {
        $trace = $e->getTraceAsString();
        $i = 1;
        do {
            $messages[] = $i++ . ": " . $e->getMessage();
        } while ($e = $e->getPrevious());

        $log = "Exception:\n" . implode("\n", $messages);
        $log .= "\nTrace:\n" . $trace;

        $this->logger->err($log);
    }
}