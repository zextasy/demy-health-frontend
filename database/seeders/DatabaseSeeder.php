<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    const DefaultPassword = '123456';

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->seedUsers();
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
            'password' => bcrypt(self::DefaultPassword),
        ]);
        $admin->assignRole('admin');

        $manager = User::firstOrCreate([
            'name' => 'Manager',
            'email' => 'manager@lzl.com',
            'password' => bcrypt(self::DefaultPassword),
        ]);
        $manager->assignRole('manager');

        $editor = User::firstOrCreate([
            'name' => 'Editor',
            'email' => 'editor@lzl.com',
            'password' => bcrypt(self::DefaultPassword),
        ]);
        $editor->assignRole('editor');

        $customer = User::firstOrCreate([
            'name' => 'Test Customer 1',
            'email' => 'customer@lzl.com',
            'password' => bcrypt(self::DefaultPassword),
        ]);
        $customer->assignRole('customer');
    }
}
