<?php

namespace Kinjari\LaravelZenblog\Models;

use Illuminate\Support\Facades\Http;

class Category extends ApiModel
{
    public static function all()
    {
        $response = Http::withHeaders(static::getApiHeaders())
            ->get(static::getApiUrl('categories'));

        $data = $response->json('data');

        return static::hydrateCollection($data);
    }

    protected static function getEndpoint()
    {
        return 'categories';
    }

    public static function paginate($perPage = 10, $page = 1, $endpoint = null)
    {
        return parent::paginate($perPage, $page, $endpoint ?? 'categories');
    }
}
