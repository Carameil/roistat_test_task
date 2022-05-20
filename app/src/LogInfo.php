<?php

namespace App;

use JetBrains\PhpStorm\ArrayShape;

class LogInfo
{
    private int $views = 0;
    private int $uniqueUrls = 0;
    private int $traffic = 0;
    private array $agents = [];
    private array $statusCodes = [];


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