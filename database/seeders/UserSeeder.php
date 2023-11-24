<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'name'         => 'Teknisi 1',
            'username'     => 'teknisi_1',
            'password'     => 'password',
            'role'         => 'teknisi',
            'team_id'      => null,
            'phone_number' => '082114578976',
            'email'        => 'teknisi_1@sistegra.id',
            'photo'        => 'pp/default.jpg',
        ]);

        User::create([
            'name'         => 'Teknisi 2',
            'username'     => 'teknisi_2',
            'password'     => 'password',
            'role'         => 'teknisi',
            'team_id'      => null,
            'phone_number' => '082114578976',
            'email'        => 'teknisi_2@sistegra.id',
            'photo'        => 'pp/default.jpg',
        ]);

        User::create([
            'name'         => 'Teknisi 3',
            'username'     => 'teknisi_3',
            'password'     => 'password',
            'role'         => 'teknisi',
            'team_id'      => null,
            'phone_number' => '082114578976',
            'email'        => 'teknisi_3@sistegra.id',
            'photo'        => 'pp/default.jpg',
        ]);
    }
}
