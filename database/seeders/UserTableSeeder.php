<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user=User::where('email','abood@abood.com')->first();

        if (!$user){
            User::create([
                'name'=>'abood',
                'email'=>'abood@abood.com',
                'role'=>'admin',
                'password'=>Hash::make('password')
            ]);
        }
    }
}
