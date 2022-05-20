<?php

namespace App;

class LogInspectionService
{
    private array $tmpUrls = [];

    public function findUnqUrl(string $url): array
    {
        if (!in_array($url, $this->tmpUrls)) {
            $this->tmpUrls[] = $url;
        }
        return $this->tmpUrls;
    }

    public function findAgent(string $rawAgent): string
    {
        $tmpAgent = explode(') ', $rawAgent);
        if (isset($tmpAgent[1])) {
            $agent = explode('/', $tmpAgent[1])[0];
        }
        else{
            $agent = 'undefined_agent';
        }
        return $agent;
    }
}