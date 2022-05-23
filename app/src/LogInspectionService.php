<?php

namespace App;

class LogInspectionService
{
    private array $tmpUrls = [];

    public function findUnqUrls(string $rawUrl): array
    {
        $url = explode(' ', $rawUrl)[1];
        if (!in_array($url, $this->tmpUrls)) {
            $this->tmpUrls[] = $url;
        }
        return $this->tmpUrls;
    }

    public static function findAgent(string $rawAgent): string
    {
        $tmpAgent = explode(') ', $rawAgent);
        if (isset($tmpAgent[1])) {
            return explode('/', $tmpAgent[1])[0];
        }
        return '';
    }

    public static function findBot(string $rawAgent): string
    {
        $agent = static::findAgent($rawAgent);
        if (empty($agent)) {
            return '';
        }
        $agent = explode('/', $agent)[0];
        $var1 = trim(stristr($agent, 'bot', true));
        $var2 = trim(stristr($agent, 'spider', true));
        if ($var1) {
            return $var1;
        } elseif ($var2) {
            return $var2;
        }
        return '';
    }
}