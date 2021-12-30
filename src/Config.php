<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly;

class Config
{
    private array $config = [
        'version' => 'latest',
        'region' => 'us-east-1',
        'debug' => false,
    ];

    public function debug(): static
    {
        return $this->set('debug', true);
    }

    public function setKey(string $accessKey): static
    {
        return $this->set('key', $accessKey);
    }

    public function setSecret(string $secretKey): static
    {
        return $this->set('secret', $secretKey);
    }

    public function setRegion(string $region): static
    {
        return $this->set('region', $region);
    }

    private function set($key, $val): static
    {
        $this->config[$key] = $val;

        return $this;
    }

    public function get(string $key)
    {
        return $this->config[$key];
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function clientConfig(): array
    {
        return [
            'version' => $this->get('version'),
            'region' => $this->get('region'),
            'debug' => $this->get('debug'),
            'credentials' => [
                'key' => $this->get('key'),
                'secret' => $this->get('secret'),
            ],
        ];
    }
}
