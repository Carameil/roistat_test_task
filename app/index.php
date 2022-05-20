<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\ReadLog;
use BenMorel\ApacheLogParser\Parser;

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

