<?php

namespace Kinjari\LaravelZenblog\Models;

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
        $baseUrl = config('zenblog.api_url');
        $blogId = config('zenblog.blog_id');

        if ($blogId) {
            return "{$baseUrl}/blogs/{$blogId}/{$path}";
        }

        return "{$baseUrl}/{$path}";
    }

    public static function getApiHeaders(): array
    {
        return [
            'Accept' => 'application/json',
        ];
    }

    public static function hydrateCollection(array $items): \Illuminate\Support\Collection
    {
        return collect($items)->map(fn ($item) => new static($item));
    }

    public static function paginate($perPage = 10, $page = 1, $endpoint = null)
    {
        $endpoint = $endpoint ?? static::getEndpoint();
        $response = \Illuminate\Support\Facades\Http::withHeaders(static::getApiHeaders())
            ->get(static::getApiUrl($endpoint), [
                'offset' => ($page - 1) * $perPage,
                'limit' => $perPage,
            ]);

        $json = $response->json();

        // Check if the response contains an error message or no data
        if (isset($json['message']) || empty($json) || ! is_array($json)) {
            // Return empty paginator when no data found
            return new \Kinjari\LaravelZenblog\Support\ZenblogPaginator(
                collect([]),
                0,
                $perPage,
                $page,
                0
            );
        }

        // Handle different possible response structures
        $items = $json['data'] ?? $json['items'] ?? $json['posts'] ?? $json;

        // Ensure items is always an array and contains actual data
        if ($items === null || ! is_array($items) || (is_array($items) && isset($items['message']))) {
            $items = [];
        }

        // Extract pagination info from different possible structures
        $pagination = $json['pagination'] ?? [];

        return new \Kinjari\LaravelZenblog\Support\ZenblogPaginator(
            static::hydrateCollection($items),
            $pagination['total'] ?? $json['total'] ?? count($items),
            $pagination['limit'] ?? $json['per_page'] ?? $perPage,
            $pagination['page'] ?? $json['current_page'] ?? $page,
            $pagination['totalPages'] ?? $json['last_page'] ?? null
        );
    }

    protected static function getEndpoint()
    {
        return '';
    }
}
