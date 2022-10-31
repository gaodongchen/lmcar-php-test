<?php

namespace App\Service;
use App\Service\Logger\L4 as L4Loger;
use App\Service\Logger\TP as TPLoger;
use Exception;

class AppLogger
{
    const TYPE_LOG4PHP = 'log4php';
    const TYPE_TPTPLOG = 'think-log';

    private $logger;

    public function __construct($type = self::TYPE_LOG4PHP)
    {
        if ($type == self::TYPE_LOG4PHP) {
            $this->logger = new L4Loger();
        } elseif ($type == self::TYPE_TPTPLOG) {
            $this->logger = new TPLoger();
        } else {
            throw new Exception('not found logger');
        }
    }

    public function info($message = '')
    {
        $this->logger->info($message);
    }

    public function debug($message = '')
    {
        $this->logger->debug($message);
    }

    public function error($message = '')
    {
        $this->logger->error($message);
    }
}