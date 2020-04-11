# Mutex

[![Actions Status](https://github.com/leocavalcante/swoole-mutex/workflows/CI/badge.svg)](https://github.com/leocavalcante/swoole-mutex/actions)

🚦 [Mutual exclusion](https://en.wikipedia.org/wiki/Mutual_exclusion) abstractions for PHP's [Swoole](https://www.swoole.co.uk/) concurrency run-time.

> With great power comes great responsibility — Uncle Ben (I guess)

[Swoole](https://www.swoole.co.uk/) awesomeness enables concurrency across multiple processes and cores, but sharing state/memory between them isn't a straightforward achievement. [`Swoole\Table`](https://www.swoole.co.uk/docs/modules/swoole-table) comes to help, but maybe we could have an even better API for that task.

**This package is a [Facade](https://en.wikipedia.org/wiki/Facade_pattern) for [`Swoole\Table`](https://www.swoole.co.uk/docs/modules/swoole-table) providing common APIs for mutual exclusion patterns.**

_We all hail [**Edsger W. Dijkstra**](https://en.wikipedia.org/wiki/Edsger_W._Dijkstra) (and [Swoole team](https://github.com/orgs/swoole/people) for their amazing work)._

## Install

```bash
composer require leocavalcante/swoole-mutex
```

## Example

Counting HTTP requests across >1 workers.

```php
use Mutex\Atomic\Integer;
use Swoole\Http\{Request, Response, Server};

$counter = new Integer();
$server = new Server('127.0.0.1', 8000);

$server->on('request', function (Request $req, Response $res) use ($counter): void {
    if ($req->server['request_uri'] !== '/favicon.ico') {
        $counter->inc();
    }

    $res->end('You are number: ' . $counter->value());
});

$server->set(['worker_num' => 4]);
$server->start();
```

---

&copy; 2k2O
