<?php

namespace Kinjari\LaravelZenblog\Models;

use Illuminate\Support\Facades\Http;

class Post extends ApiModel
{

    public static function all()
    {
        $response = Http::withHeaders(static::getApiHeaders())
            ->get(static::getApiUrl('posts'));

        $data = $response->json('data');

        return static::hydrateCollection($data);
    }

    public static function find($slug)
    {
        $response = Http::withHeaders(static::getApiHeaders())
            ->get(static::getApiUrl("posts/{$slug}"));

        $data = $response->json('data');

        return $data ? new static($data) : null;
    }

    protected static function getEndpoint()
    {
        return 'posts';
    }

    public static function paginate($perPage = 10, $page = 1, $endpoint = null)
    {
        return parent::paginate($perPage, $page, $endpoint ?? 'posts');
    }

}
