<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DoctorAuthSeeder extends Seeder
{
    public function run(): void
    {
        $doctors = Doctor::all();

        foreach ($doctors as $doctor) {

            /*
            |--------------------------------------------------------------------------
            | NAME PARTS
            |--------------------------------------------------------------------------
            */

            $cleanName = str_replace('Dr.', '', $doctor->name);

            $parts = explode(' ', trim($cleanName));

            /*
            |--------------------------------------------------------------------------
            | USERNAME FROM SECOND WORD
            |--------------------------------------------------------------------------
            */

            $username = strtolower($parts[1] ?? $parts[0]);

            $username = preg_replace('/[^a-z0-9]/', '', $username);

            /*
            |--------------------------------------------------------------------------
            | UNIQUE USERNAME
            |--------------------------------------------------------------------------
            */

            $originalUsername = $username;

            $count = 1;

            while (
                User::where('username', $username)->exists()
            ) {

                $username = $originalUsername . $count;
                $count++;
            }

            /*
            |--------------------------------------------------------------------------
            | EMAIL
            |--------------------------------------------------------------------------
            */

            $email = $username . '@doctor.com';

            /*
            |--------------------------------------------------------------------------
            | SKIP IF EXISTS
            |--------------------------------------------------------------------------
            */

            if (User::where('email', $email)->exists()) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | CREATE USER
            |--------------------------------------------------------------------------
            */
            $user = User::create([
                'name'      => $doctor->name,
                'username'  => $username,
                'email'     => $email,
                'password'  => Hash::make('Admin123'),

            ]);

            /*
            |--------------------------------------------------------------------------
            | UPDATE DOCTOR
            |--------------------------------------------------------------------------
            */

            $doctor->user_id = $user->id;

            $doctor->save();
        }
    }
}
