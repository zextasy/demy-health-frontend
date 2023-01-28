<?php

namespace App\Jobs\Middleware;

use Illuminate\Support\Facades\Redis;

class SendCommunicationRateLimit
{
    /**
     * @throws \Illuminate\Contracts\Redis\LimiterTimeoutException
     */
    public function handle(mixed $job, callable $next)
    {
        Redis::throttle('pending-communications')
            ->block(0)
            ->allow(10) //TODO use config value
            ->every(5)
            ->then(function() use ($job, $next) {
                $next($job);
            }, function() use ($job) {
                $job->release(1);
            });
    }
}
