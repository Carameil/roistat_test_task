<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\ReadLog;
use BenMorel\ApacheLogParser\Parser;
use App\LogInfo;
use App\LogInspectionService;

const PATH_TO_FILE = __DIR__ . '/logs/access_log';
/*
 * @link https://httpd.apache.org/docs/2.2/logs.html#combined
 * */
$logFormat = "%h %l %u %t \"%r\" %>s %b \"%{Referer}i\" \"%{User-agent}i\"";
$reader = new ReadLog();
/*
 * @link https://github.com/BenMorel/apache-log-parser
 * */
$parser = new Parser($logFormat);
$logService = new LogInspectionService();
$calculator = new LogInfo($logService);

foreach ($reader->getLines(PATH_TO_FILE) as $line) {
    try {
        $data = $parser->parse($line, true);
    } catch (\Throwable $exception) {
        die($exception->getMessage());
    }
    $calculator->increaseViews();
}

$statistic = $calculator->getAllStats();
header('Content-Type: application/json; charset=utf-8');
echo json_encode($statistic);