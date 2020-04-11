# Mutex

Mutual exclusion abstractions for PHP's [Swoole](https://www.swoole.co.uk/) concurrency run-time.

> With great power comes great responsibility — Uncle Ben (I guess)

[Swoole](https://www.swoole.co.uk/) awesomeness enables concurrency across multiple process and cores, but sharing state between them isn't a straightforward achievement. [`Swoole\Table`](https://www.swoole.co.uk/docs/modules/swoole-table) comes to help, but maybe we could have an even better API for that task.

This package is a [Facade](https://en.wikipedia.org/wiki/Facade_pattern) for [`Swoole\Table`](https://www.swoole.co.uk/docs/modules/swoole-table) providing common APIs for mutual exclusion patterns.

And we all hail **Edsger W. Dijkstra**.
