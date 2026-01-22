<?php

namespace Kinjari\LaravelZenblog\Models;

use Illuminate\Support\Facades\Http;

class Tag extends ApiModel
{
    public static function all()
    {
        $response = Http::withHeaders(static::getApiHeaders())
            ->get(static::getApiUrl('tags'));

        $data = $response->json('data');

        return static::hydrateCollection($data);
    }

    protected static function getEndpoint()
    {
        return 'tags';
    }

    public static function paginate($perPage = 10, $page = 1, $endpoint = null)
    {
        return parent::paginate($perPage, $page, $endpoint ?? 'tags');
    }
}
