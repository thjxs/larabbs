<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Faker\Generator::class);

        $users = factory(User::class)
                        ->times(10)
                        ->make();

        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        User::insert($user_array);

        $user = User::first();
        $user->name = 'Tan';
        $user->email = 'tanhongjianx@163.com';
        $user->assignRole('Founder');
        $user->save();

        $user = User::find(2);
        $user->email = 'T@mail.com';
        $user->assignRole('Maintainer');
    }
}
