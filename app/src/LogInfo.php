<?php

namespace App;

use JetBrains\PhpStorm\ArrayShape;

class LogInfo
{
    private LogInspectionService $logService;

    private int $views = 0;
    private int $uniqueUrls = 0;
    private int $traffic = 0;
    private array $agents = [];
    private array $statusCodes = [];

    private array $tmpUrls = [];

    public function __construct(LogInspectionService $logService)
    {
        $this->logService = $logService;
    }

    public function increaseViews(): void
    {
        $this->views++;
    }

    public function findUnqUrl(string $url): void
    {
        $this->tmpUrls = $this->logService->findUnqUrl($url);
    }

    public function calcUnqUrls(): void
    {
        $this->uniqueUrls = count($this->tmpUrls);
    }

    public function calcTraffic(int $bytes): void
    {
        $this->traffic += $bytes;
    }

    public function calcStatCodes(int $status): void
    {
        if (isset($this->statusCodes[$status])) {
            $this->statusCodes[$status] += 1;
        } else {
            $this->statusCodes[$status] = 1;
        }
    }

    public function calcAgents(string $rawAgent): void
    {
        $tmpAgent = $this->logService->findAgent($rawAgent);
        if (isset($this->agents[$tmpAgent])) {
            $this->agents[$tmpAgent] += 1;
        } else {
            $this->agents[$tmpAgent] = 1;
        }

    }

    public function sortArrays(): void
    {
        ksort($this->agents,SORT_STRING);
        ksort($this->statusCodes,SORT_NUMERIC);
    }

    #[ArrayShape([
        'views' => "int",
        'uniqueUrl' => "int",
        'traffic' => "int",
        'agents' => "array",
        'statusCodes' => "array"
    ])] public function getAllStats(): array
    {
        return [
            'views' => $this->views,
            'uniqueUrl' => $this->uniqueUrls,
            'traffic' => $this->traffic,
            'agents' => $this->agents,
            'statusCodes' => $this->statusCodes,
        ];
    }
}