<?php

namespace Kinjari\LaravelZenblog\Commands;

use Illuminate\Console\Command;

class LaravelZenblogCommand extends Command
{
    public $signature = 'laravel-zenblog';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
