<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\Link;
use App\Models\Resource;
use App\Models\Snippet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($modelCount = 20; $modelCount > 0; $modelCount--){
            $resourceables = [
                File::class,
                Link::class,
                Snippet::class,
            ];

            $resourceablesType = $resourceables[rand(0, count($resourceables) - 1)];
            Resource::factory()->count(1)->for(
                $resourceablesType::factory(), 'resourceable'
            )->create();
        }
    }
}
