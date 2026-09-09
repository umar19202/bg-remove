<?php

namespace Database\Seeders;

use App\Models\Tool;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $tools = [
            [
                'name' => 'Remove Background',
                'slug' => 'remove-background',
                'description' => 'Remove the background from any image and get a clean, transparent PNG cutout.',
                'route' => '/remove-background',
                'icon' => 'bi-scissors',
                'is_active' => true,
            ],
            [
                'name' => 'Change Background',
                'slug' => 'change-background',
                'description' => 'Replace the background of any image with a new one from our gallery or your own upload.',
                'route' => '/change-background',
                'icon' => 'bi-palette',
                'is_active' => true,
            ],
            [
                'name' => 'Bulk Remove',
                'slug' => 'bulk-remove',
                'description' => 'Remove backgrounds from multiple images at once and download them as a ZIP file.',
                'route' => '/bulk-remove',
                'icon' => 'bi-layers',
                'is_active' => true,
            ],
        ];

        foreach ($tools as $tool) {
            Tool::create($tool);
        }
    }
}
