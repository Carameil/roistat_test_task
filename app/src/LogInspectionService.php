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
}