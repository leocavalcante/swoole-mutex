<?php declare(strict_types=1);

namespace App;

use Mutex\Atomic\Integer;
use Swoole\Http\{Request, Response, Server};

require_once __DIR__ . '/../../vendor/autoload.php';

$counter = new Integer();
$server = new Server('0.0.0.0', 8000);

$server->on('request', function (Request $req, Response $res) use ($counter): void {
    if ($req->server['request_uri'] !== '/favicon.ico') {
        $counter->inc();
    }

    $res->end('You are number: ' . $counter->value());
});

$server->set(['worker_num' => 4]);
$server->start();
