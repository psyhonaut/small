<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
          [
            'name'      => 'Даурен Сабитов',
            'role'      => 10,
            'email'     => 'dauren@mail.ru',
            'email_verified_at' => now(),
            'password'  => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10)
          ],
          [
            'name'      => 'Тимур Иманбаев',
            'role'      => 10,
            'email'     => 'timur@mail.ru',
            'email_verified_at' => now(),
            'password'  => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10)
          ]
        ];

        DB::table('users')->insert($data);
    }
}
