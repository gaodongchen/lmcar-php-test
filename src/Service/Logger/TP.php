<?php

namespace App\Service\Logger;

use think\facade\Log as Logger;

class TP
{
    public function info($message = '')
    {
        Logger::info($this->handleMessage($message));
    }

    public function debug($message = '')
    {
        Logger::debug($this->handleMessage($message));
    }

    public function error($message = '')
    {
        Logger::error($this->handleMessage($message));
    }

    private function handleMessage(string $message): string
    {
        return strtoupper($message);
    }
}