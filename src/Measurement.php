<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly;

class Measurement
{
    private float $start;

    public static function start(): static
    {
        return (new self())->begin();
    }

    public function begin(): static
    {
        $this->start = microtime(true);

        return $this;
    }

    public function finish(): float
    {
        return round(microtime(true) - $this->start, 2);
    }
}
