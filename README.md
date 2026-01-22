# A Laravel package for using Zenblog in your projects.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/kinjari/laravel-zenblog.svg?style=flat-square)](https://packagist.org/packages/kinjari/laravel-zenblog)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/kinjari/laravel-zenblog/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/kinjari/laravel-zenblog/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/kinjari/laravel-zenblog/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/kinjari/laravel-zenblog/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/kinjari/laravel-zenblog.svg?style=flat-square)](https://packagist.org/packages/kinjari/laravel-zenblog)

A Laravel package that provides a simple and elegant interface to interact with the Zenblog API. Fetch posts, categories, tags, and authors with ease using Laravel's familiar syntax.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-zenblog.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-zenblog)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require kinjari/laravel-zenblog
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-zenblog-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-zenblog-config"
```

This is the contents of the published config file:

```php
return [
    'api_url' => env('ZENBLOG_API_URL', 'https://demo.zenblog.org/api'),
    'blog_id' => env('ZENBLOG_BLOG_ID', null),
];
```

## Configuration

Add these environment variables to your `.env` file:

```bash
# Required: Your Zenblog API URL
ZENBLOG_API_URL=https://your-blog.zenblog.com/api

# Optional: Your Blog ID for authentication (if required by your Zenblog instance)
ZENBLOG_BLOG_ID=your-blog-id-from-dashboard
```

The `blog_id` is required for most Zenblog installations and will be included in the API URL path as `/blogs/{blog_id}/...`. You can find your blog ID in the Zenblog dashboard.

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-zenblog-views"
```

## Usage

The package provides four models to interact with the Zenblog API: `Post`, `Category`, `Tag`, and `Author`. Each model supports the same methods for fetching data.

### Posts

```php
use Kinjari\LaravelZenblog\Models\Post;

// Get all posts
$posts = Post::all();

// Find a specific post by slug
$post = Post::find('my-blog-post');

// Get paginated posts
$paginatedPosts = Post::paginate(10, 1); // 10 per page, page 1
```

### Categories

```php
use Kinjari\LaravelZenblog\Models\Category;

// Get all categories
$categories = Category::all();

// Get paginated categories
$paginatedCategories = Category::paginate(10, 1);
```

### Tags

```php
use Kinjari\LaravelZenblog\Models\Tag;

// Get all tags
$tags = Tag::all();

// Get paginated tags
$paginatedTags = Tag::paginate(10, 1);
```

### Authors

```php
use Kinjari\LaravelZenblog\Models\Author;

// Get all authors
$authors = Author::all();

// Find a specific author by slug
$author = Author::find('john-doe');

// Get paginated authors
$paginatedAuthors = Author::paginate(10, 1);
```

### Working with Results

All models return collections or individual model instances with accessible attributes:

```php
$post = Post::find('my-blog-post');
echo $post->title;
echo $post->content;
echo $post->slug;

$posts = Post::all();
foreach ($posts as $post) {
    echo $post->title;
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [kinjari](https://github.com/kinjari)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
