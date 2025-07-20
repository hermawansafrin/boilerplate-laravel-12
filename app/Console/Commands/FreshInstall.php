<?php

namespace App\Console\Commands;

use Database\Seeders\UserWithPermissionSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class FreshInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fresh-install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fresh install the application including database, seeders, and other configurations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->clearCache();
        $this->clearStorage();
        $this->generateBaseSeedAndMigration();
    }

    /**
     * Generate base seed and migration
     *
     * @return void
     */
    private function generateBaseSeedAndMigration()
    {
        $this->makeFreshTable();
        $this->generateAllSeed();

        $this->info('Base seed and migration generated successfully');
        $this->newLine();
    }

    /**
     * Generate all seed
     *
     * @return void
     */
    private function generateAllSeed()
    {
        $this->comment('Seeding database...');

        $seeders = [
            // some reference seeder
            UserWithPermissionSeeder::class, // must be first seed (after reference) cause there is user creation with role permission data
        ];

        collect($seeders)->each(function ($seeder) {
            $this->seedingOutput($seeder);
            $this->callSilent('db:seed', ['--class' => $seeder]);
        });

        $this->info('Database seeded successfully');
        $this->newLine();
    }

    /**
     * Make fresh table
     *
     * @return void
     */
    private function makeFreshTable()
    {
        $this->comment('Making fresh table...');
        $this->callSilent('migrate:fresh');
        $this->info('Fresh table made successfully');

        $this->newLine();
    }

    /**
     * Clear the storage
     *
     * @return void
     */
    private function clearStorage()
    {
        $this->comment('Clearing storage...');

        $storages = [
            'public',
            // add here if there is anything else
        ];

        foreach ($storages as $storage) {
            $this->comment('Clearing ' . $storage . ' storage...');
            Storage::disk($storage)->deleteDirectory('/');
        }

        /** create symlink */
        $this->comment('Creating symlink...');
        $this->callSilent('storage:link');
        $this->info('Storage cleared successfully');

        $this->newLine();
    }

    /**
     * Clear the cache
     *
     * @return void
     */
    private function clearCache()
    {
        $this->comment('Clearing cache...');
        try {
            collect([
                'event:clear',
                'view:clear',
                'cache:clear',
                'config:clear',
                'config:cache',
                'route:clear',
            ])->each(function ($command) {
                $this->callSilent($command);
            });

            $this->info('Cache cleared successfully');
        } catch (\Exception $e) {
            $this->error('Failed to clear cache: ' . $e->getMessage());
        }
    }

    /**
     * Console output seeding class
     *
     * @param  string  $lass
     */
    private function seedingOutput(string $class): void
    {
        $this->line("<comment>Seeding : </comment> {$this->cyan($class)}");
    }

    /**
     * Formatting command style
     */
    private function cyan(string $message): string
    {
        return "<fg=cyan>{$message}</>";
    }
}
