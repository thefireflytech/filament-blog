<?php

namespace Firefly\FilamentBlog\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RenameTablesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filament-blog:upgrade-tables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command helps to rename the tables. The tables name are now configurable in filament-blog config file.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call('migrate', [
            '--path' => 'vendor/firefly/filament-blog/database/migrations/2024_05_11_152936_create_add_prefix_on_all_blog_tables.php',
            '--force' => true,
        ]);
        $this->info('Tables have been renamed successfully.');
    }
}
