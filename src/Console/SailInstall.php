<?php

namespace Oddvalue\Sail\Console;

use Illuminate\Console\Command;

class SailInstall extends Command
{
    protected $description = 'Install Laravel Sail\'s default Docker Compose file';

    protected $signature = 'sail:install';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        copy(__DIR__.'/../../stubs/docker-compose.yml', base_path('docker-compose.yml'));

        $environment = file_get_contents(base_path('.env'));

        $environment = str_replace('DB_HOST=127.0.0.1', 'DB_HOST=mysql', $environment);
        $environment = str_replace('MEMCACHED_HOST=127.0.0.1', 'MEMCACHED_HOST=memcached', $environment);
        $environment = str_replace('REDIS_HOST=127.0.0.1', 'REDIS_HOST=redis', $environment);

        file_put_contents(base_path('.env'), $environment);
    }
}
