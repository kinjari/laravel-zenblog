<?php

namespace Kinjari\LaravelZenblog;

use Kinjari\LaravelZenblog\Commands\LaravelZenblogCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelZenblogServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-zenblog')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_zenblog_table')
            ->hasCommand(LaravelZenblogCommand::class);
    }
}
