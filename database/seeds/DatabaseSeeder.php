<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'Fleet',
            'staff_id' => '12345',
            'email' => 'admin@rentacar.com',
            'password' => Hash::make('password'),
            'created_at' => NOW(),
            'updated_at' => NOW(),
            'company_access' => '0',
            'admin_type' => '0',
            'logged_by' => 1,
            'created_by' => 0,
            'cid' => 0,
            'del' => 0,
            'user_type' => 1,
            'user_status' => 1,
            'deleted_at' => NOW(),
            'last_logged_in' => NOW(),
            'phone_number' => '080808080',
            'contact_address' => '32 Eleko',
            'invoice_approval' => '1',
            'module_access' => 12,
        ]);

    }
}
