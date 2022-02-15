<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        User::truncate();

        $password = Hash::make('patient');
        User::create([
            'name' => 'Admin',
            'email' => 'admin@patient.com',
            'password' => $password,
            'api_token' => 'hwyeHJE1hbLtKY1szbIHstOehaAugl9WHAzcliTGutfE6xY6Ht2DzHbPqNgn'
        ]);
    }

}
