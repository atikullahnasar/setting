<?php

namespace atikullahnasar\setting\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->runSqlFile('../sqlFile/country.sql');
        $this->runSqlFile(__DIR__ . '/../sqlFile/country.sql');
    }

    protected function runSqlFile(string $path): void
    {
        if (File::exists($path)) {
            $sql = File::get($path);
            // Split queries by semicolon if there are multiple statements
            foreach (array_filter(array_map('trim', explode(';', $sql))) as $statement) {
                DB::unprepared($statement);
            }
            $this->command->info("✅ SQL file executed: {$path}");
        } else {
            $this->command->warn("⚠️ SQL file not found: {$path}");
        }
    }
}
