<?php

namespace Kinjari\LaravelZenblog\Models;

use Illuminate\Support\Facades\Http;

abstract class ApiModel
{
    protected array $attributes = [];

    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    public function __get($key)
    {
        return $this->attributes[$key] ?? null;
    }

    public static function getApiUrl(string $path = ''): string
    {
        return config('zenblog.api_url') . '/' . $path;
    }

    public static function getApiHeaders(): array
    {
        return [
            'Accept' => 'application/json',
        ];
    }

    public static function hydrateCollection(array $items): \Illuminate\Support\Collection
    {
        return collect($items)->map(fn($item) => new static($item));
    }

    public static function paginate($perPage = 10, $page = 1, $endpoint = null)
    {
        $endpoint = $endpoint ?? static::getEndpoint();
        $response = \Illuminate\Support\Facades\Http::withHeaders(static::getApiHeaders())
            ->get(static::getApiUrl($endpoint), [
                'per_page' => $perPage,
                'page' => $page,
            ]);
        $json = $response->json();
        $items = $json['data'] ?? $json['items'] ?? $json;
        return new \Kinjari\LaravelZenblog\Support\ZenblogPaginator(
            static::hydrateCollection($items),
            $json['total'] ?? null,
            $json['per_page'] ?? $perPage,
            $json['current_page'] ?? $page,
            $json['last_page'] ?? null
        );
    }

    protected static function getEndpoint()
    {
        return '';
    }
}
