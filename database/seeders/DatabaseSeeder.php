<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    const DEFAULT_PASSWORD = '123456';

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BusinessGroupSeeder::class);
        $this->seedUsers();
        $this->call(UserSeeder::class);
        $this->call(StateSeeder::class);
        $this->call(LocalGovernmentAreaSeeder::class);
        $this->call(TestCenterSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(SpecimenTypeSeeder::class);
        $this->call(TestTypeSeeder::class);
    }

    private function seedUsers()
    {
        $admin = User::firstOrCreate([
           'name' => 'Admin',
            'email' => 'admin@lzl.com',
            'password' => bcrypt(self::DEFAULT_PASSWORD),
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        $manager = User::firstOrCreate([
            'name' => 'Manager',
            'email' => 'manager@lzl.com',
            'password' => bcrypt(self::DEFAULT_PASSWORD),
            'email_verified_at' => now(),
        ]);
        $manager->assignRole('manager');

        $editor = User::firstOrCreate([
            'name' => 'Editor',
            'email' => 'editor@lzl.com',
            'password' => bcrypt(self::DEFAULT_PASSWORD),
            'email_verified_at' => now(),
        ]);
        $editor->assignRole('editor');

        $customer = User::firstOrCreate([
            'name' => 'Test Customer 1',
            'email' => 'customer@lzl.com',
            'password' => bcrypt(self::DEFAULT_PASSWORD),
            'email_verified_at' => now(),
        ]);
        $customer->assignRole('customer');
    }
}
