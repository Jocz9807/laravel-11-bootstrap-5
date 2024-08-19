<?php

namespace Database\Seeders;

use App\Models\Voter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VotersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    Voter::create(['ic_number' => '123456789012']);
    Voter::create(['ic_number' => '987654321098']);
}
}
