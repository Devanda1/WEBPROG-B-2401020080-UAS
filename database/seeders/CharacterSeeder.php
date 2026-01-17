<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Character;

class CharacterSeeder extends Seeder
{
    public function run(): void
    {
        Character::create([
            'name' => 'Lara Croft',
            'game' => 'Tomb Raider',
            'role' => 'Adventurer',
            'image' => 'lara.jpg',
            'description' => 'Petualang legendaris.'
        ]);
    }
}
