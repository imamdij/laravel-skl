<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User;
        $user->name = 'Imam Admin Slot';
        $user->email = 'imamadminslot@admin.slot';
        $user->level = 'Admin';
        $user->password = Hash::make('1234566789');
        $user->save();
    }
}
