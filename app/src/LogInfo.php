<?php

namespace App;

use JetBrains\PhpStorm\ArrayShape;

class LogInfo
{
    private LogInspectionService $logService;

    private int $views = 0;
    private int $uniqueUrls = 0;
    private int $traffic = 0;
    private array $bots = [
        'Google' => 0,
        'Bing' => 0,
        'Baidu' => 0,
        'Yandex' => 0
    ];
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
        $this->tmpUrls = $this->logService->findUnqUrls($url);
    }

    public function calcUnqUrls(): void
    {
        $this->uniqueUrls = count($this->tmpUrls);
    }

    public function calcTraffic(int $bytes, int $status): void
    {
        if ($status >= 200 && $status < 300) {
            $this->traffic += $bytes;
        }
    }

    public function calcStatCodes(int $status): void
    {
        if (isset($this->statusCodes[$status])) {
            $this->statusCodes[$status] += 1;
        } else {
            $this->statusCodes[$status] = 1;
        }
    }

    public function calcBots(string $rawAgent): void
    {
        $tmpBots = LogInspectionService::findBot($rawAgent);
        if ($tmpBots != '') {
            if (isset($this->bots[$tmpBots])) {
                $this->bots[$tmpBots] += 1;
            } else {
                $this->bots[$tmpBots] = 1;
            }
        }
    }

    public function sortArrays(): void
    {
        ksort($this->bots, SORT_STRING);
        ksort($this->statusCodes, SORT_NUMERIC);
    }

    #[ArrayShape([
        'views' => "int",
        'uniqueUrls' => "int",
        'traffic' => "int",
        'bots' => "array",
        'statusCodes' => "array"
    ])] public function getAllStats(): array
    {
        return [
            'views' => $this->views,
            'uniqueUrls' => $this->uniqueUrls,
            'traffic' => $this->traffic,
            'bots' => $this->bots,
            'statusCodes' => $this->statusCodes,
        ];
    }
}