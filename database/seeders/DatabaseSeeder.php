<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CoffeePot;
use App\Models\Role;
use App\Models\User;
use App\Models\UserCoffeePotPivot;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            "name" => "admin",
            "phone" => "+79999999999",
            "phone_verified_at" => now(),
            "password" => bcrypt("admin"),
            "agreement" => "1",
            "role_id" => "1",
            "remember_token" => Str::random(10),
        ]);
        
        User::factory()->create([
            "name" => "Василий",
            "last_name" => "Петров",
            "phone" => "+79998888888",
            "phone_verified_at" => now(),
            "password" => bcrypt("coffeepot"),
            "agreement" => "1",
            "role_id" => "2",
            "remember_token" => Str::random(10),
        ]);

        User::factory()->create([
            "name" => "Андрей",
            "last_name" => "Иванов",
            "phone" => "+79997777777",
            "phone_verified_at" => now(),
            "password" => bcrypt("user"),
            "agreement" => "1",
            "role_id" => "3",
            "remember_token" => Str::random(10),
        ]);

        Role::factory()->create([
            "name" => "admin"
        ]);

        Role::factory()->create([
            "name" => "coffeePot"
        ]);

        Role::factory()->create([
            "name" => "user"
        ]);

        UserCoffeePotPivot::factory(1)->create();
        CoffeePot::factory(1)->create();
    }
}
