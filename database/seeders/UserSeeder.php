<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'         => 'Super Admin',
            'username'     => 'superadmin',
            'password'     => 'password',
            'role'         => 'admin',
            'team_id'      => null,
            'phone_number' => '082114578976',
            'email'        => 'admin@sistegra.id',
            'photo'        => 'pp/default.jpg',
        ]);

        User::create([
            'name'         => 'Admin Gudang',
            'username'     => 'gudang',
            'password'     => 'password',
            'role'         => 'gudang',
            'team_id'      => null,
            'phone_number' => '082114578976',
            'email'        => 'gudang@sistegra.id',
            'photo'        => 'pp/default.jpg',
        ]);

        User::create([
            'name'         => 'Teknisi Team 1',
            'username'     => 'teknisi_1',
            'password'     => 'password',
            'role'         => 'teknisi',
            'phone_number' => '082114578976',
            'email'        => 'teknisi_1@sistegra.id',
            'photo'        => 'pp/default.jpg',
            'team_id'      => 1,
        ]);
        Team::find(1)->increment('counter');

        User::create([
            'name'         => 'Teknisi Team 2',
            'username'     => 'teknisi_2',
            'password'     => 'password',
            'role'         => 'teknisi',
            'phone_number' => '082114578976',
            'email'        => 'teknisi_2@sistegra.id',
            'photo'        => 'pp/default.jpg',
            'team_id'      => 2,
        ]);
        Team::find(2)->increment('counter');

        User::create([
            'name'         => 'Teknisi Team 3',
            'username'     => 'teknisi_3',
            'password'     => 'password',
            'role'         => 'teknisi',
            'phone_number' => '082114578976',
            'email'        => 'teknisi_3@sistegra.id',
            'photo'        => 'pp/default.jpg',
            'team_id'      => 3,
        ]);
        Team::find(3)->increment('counter');
    }
}
