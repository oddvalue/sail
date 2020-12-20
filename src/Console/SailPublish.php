<?php

namespace Oddvalue\Sail\Console;

use Illuminate\Console\Command;

class SailPublish extends Command
{
    protected $description = 'Publish the Laravel Sail Docker files';

    protected $signature = 'sail:publish';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->call('vendor:publish', ['--tag' => 'sail']);

        file_put_contents(base_path('docker-compose.yml'), str_replace(
            './vendor/laravel/sail/runtimes/8.0',
            './docker/8.0',
            file_get_contents(base_path('docker-compose.yml'))
        ));
    }
}
